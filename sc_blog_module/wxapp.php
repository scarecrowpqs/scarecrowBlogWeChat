<?php
/**
 * sc_blog模块小程序接口定义
 *
 * @author isuoge
 * @url
 */
defined('IN_IA') or exit('Access Denied');
require_once  __DIR__ . "/ScarecrowTool.php";

class Sc_blogModuleWxapp extends WeModuleWxapp {
	// public $token = 'ScarecrowToken';
	
	public function doPageTest(){
		global $_GPC, $_W;
		$errno = 0;
		$message = '返回消息';
		$data = $_GPC;
		return $this->result($errno, $message, $data);
	}
	
	/**
	 * 用户关于页面获取管理员相关数据
	 *
	 * @return void
	 */
	public function doPageGetAdminUserInfo() {
		global $_GPC, $_W;
		$userSql = "SELECT nickname,imgurl,sex FROM ims_sc_blog_users WHERE is_admin=1";
		$userData = pdo_fetch($userSql);
		$relData = $userData;
		
		$getArtilesNumSql = "SELECT COUNT(id) as num FROM ims_sc_blog_articles";
		$getArtilesNum = pdo_fetch($getArtilesNumSql);
		$relData['artilesNum'] = $getArtilesNum['num'];
		$requestNumSql = "SELECT COUNT(id) as num FROM ims_sc_blog_requestlog";
		$requestNum = pdo_fetch($requestNumSql);
		$relData['requestNum'] = $requestNum['num'];
		$relData['sex'] = $userData['sex'] == 1 ? "男" : "女";
		
		$getAllWorksListSql = "SELECT * FROM ims_sc_blog_works";
		$getAllWorksList = pdo_fetchall($getAllWorksListSql);
		$relData['worksNum'] = count($getAllWorksList);
		
		$tempData = [];
		foreach($getAllWorksList as $item ) {
			$tempData[] = [
				'name'	=>	$item['name'],
				'imgHref'	=>	$item['img_href'],
				'toHref'	=>	$item['to_href'],
				'introduce'	=>	$item['introduce']
			];
		}
		$relData['worksLinkList'] = $tempData;
		return $this->result(0, "", $relData);
	}
	
	/**
	 * 添加访问记录
	 *
	 * @return void
	 */
	public function doPageAddRequestLog() {
		global $_GPC, $_W;
		$ip = getClientIp();
		$create_at = time();
		$option_id = $_GPC['scene'];
		$iCnt = pdo_insert('ims_sc_blog_requestlog', [
			'ip'	=>	$ip,
			'create_at'	=>	$create_at,
			'option_id'	=>	$option_id
		]);
		if ($iCnt) {
			return $this->result(0, "");
		} else {
			return $this->result(1, "");
		}
		
	}
	
	/**
	 * 获取所有友链
	 *
	 * @return void
	 */
	public function doPageGetAllFrendsLink() {
		$getAllFrendLinkSql = "SELECT * FROM  ims_sc_blog_links WHERE spread_id != 0 AND status=1";
		$allFrendLinkArr = pdo_fetchall($getAllFrendLinkSql);
		$allFrendLinkList = [];
		foreach ($allFrendLinkArr as $item) {
			$allFrendLinkList[] = [
				'name'	=>	$item['title'],
				'imgHref'	=>	$item['pic'],
				'toHref'	=>	$item['url'],
				'introduce'	=>	$item['texts']
			];
		}
		
		return $this->result(0, "", $allFrendLinkList);
	}
	
	/**
	 * 分页获取微语数据
	 *
	 * @return void
	 */
	public function doPageGetAllWeiYu() {
		global $_GPC, $_W;
		$page = (int)$_GPC['page'];
		$limit = (int)$_GPC['limit'];
		
		$index = ($page - 1) * $limit;
		
		$getDataSql = "SELECT * FROM ims_sc_blog_weiyu WHERE status=1 ORDER BY cdat DESC LIMIT {$index},$limit";
		$allData = pdo_fetchall($getDataSql);
		$relData = [];
		foreach($allData as $item) {
			$relData[] = [
				'showTime'	=>	date("Y-m-d H:i:s", $item['cdat']),
				'showStr'	=>	$item['content'],
				'id'		=>	$item['id']
			];
		}
		return $this->result(0, '', $relData);
	}
	
	/**
	 * 获取所有留言信息
	 *
	 * @return void
	 */
	public function doPageGetAllMsg() {
		global $_GPC, $_W;
		$page = (int)$_GPC['page'];
		$limit = (int)$_GPC['limit'];
		
		$index = ($page - 1) * $limit;
		
		$getDataSql = "SELECT t1.id,t1.content,t1.cdat,t2.nickname,t2.avatar FROM ims_sc_blog_comments as t1 LEFT JOIN ims_mc_members t2 ON t1.uid=t2.uid WHERE t1.is_open=1 ORDER BY cdat DESC LIMIT {$index},$limit";
		$allData = pdo_fetchall($getDataSql);
		$relData = [];
		foreach($allData as $item) {
			$relData[] = [
				'addTimes'		=>	date("Y-m-d H:i:s", $item['cdat']),
				'userSayStr'	=>	$item['content'],
				'id'			=>	$item['id'],
				'userName'		=>	$item['nickname'],
				'userImgHref'	=>	$item['avatar']
			];
		}
		return $this->result(0, '', $relData);
	}
	
	/**
	 * 添加留言
	 *
	 * @return void
	 */
	public function doPageAddMsg() {
		global $_GPC, $_W;
		$uid = $_W['fans']['uid'];
		if (!$uid) {
			return $this->result(0,'',[
				'code'	=>	1,
				'msg'	=>	'未获取到用户信息请重新登录'
			]);
		} 
		
		$content = $_GPC['msg'] ?? "";
		$times = time();
		$data = [
			'is_open'	=>	0,
			'uid'		=>	$uid,
			'content'	=>	$content,
			'cdat'		=>	$times
		];
		$iCnt = pdo_insert('ims_sc_blog_comments', $data);
		if ($iCnt) {
			return $this->result(0, '留言成功',['code'	=>	0,'msg'	=>'未获取到用户信息请重新登录','id'=>pdo_insertid(),'times'=>date("Y-m-d H:i:s", $times)]);
		} else {
			return $this->result(1, '数据库错误');
		}
		
	}
	
	/**
	 * 获取登录信息
	 *
	 * @return void
	 */
	public function doPageGetUserOpenId() {
		global $_GPC, $_W;
		return $this->result(0, "", ['uid'=>$_W['fans']['uid'], 'avatar'=>$_W['fans']['avatar'], 'nickName'=>$_W['fans']['nickname']]);
	}
	
	/**
	 * 获取所有的数据
	 *
	 * @return void
	 */
	public function doPageGetAllArticle() {
		global $_W,$_GPC;
		$lx = (int)($_GPC['lx'] ?? 1);
		$fl =(int)($_GPC['fl'] ?? 1);
		$fbsj = (int)($_GPC['fbsj'] ?? 1);
		$gjz = $_GPC['gjz'] ?? '';
		$page = (int)($_GPC['page'] ?? 1);
		$limit = (int)($_GPC['limit'] ?? 10);
		
		$index = ($page - 1) * $limit;
		$sql = "SELECT id,title,readnum,likenum,cdat,imgurl FROM ims_sc_blog_articles ";
		$whereStr = [];
		if ($lx == 2) {
			$whereStr[] = "(recommend=1)";
		}
		
		if ($fl != 1) {
			$whereStr[] = "(cid={$fl})";
		}
		
		switch($fbsj) {
			case 2:
				$dateNum = 7;

				break;
			case 3:
				$dateNum = 30;
				break;
			case 4:
				$dateNum = 90;
				break;
			default:
				$dateNum = 0;
		}
		
		if ($dateNum != 0) {
			$endTime = time();
			$startTime = $endTime - $dateNum * 86400;
			$whereStr[] = "(cdat>={$startTime} AND cdat < {$endTime})";
		}
		
		if ($gjz) {
			$whereStr[] = "(title like '%{$gjz}%')";
		}
		
		$whereStr[] = "(openlevel=1)";
		$sqlWhere = join(" AND ",$whereStr);
		$sql .= " WHERE " . $sqlWhere . " ORDER BY cdat LIMIT {$index},{$limit};";
		$allArticle = pdo_fetchall($sql);
		$relData = [];
		foreach($allArticle as $item) {
			$relData[] = [
				'title'	=>	$item['title'],
				'time'	=>	date("Y-m-d H:i:s", $item['cdat']),
				'zan'	=>	$item['likenum'],
				'read'	=>	$item['readnum'],
				'imgHref'	=>		$item['imgurl'],
				'aid'	=>	$item['id']
			];
		}
		return $this->result(0, "", $relData);
	}
	
	/**
	 * 获取一篇博文详情
	 *
	 * @return void
	 */
	public function doPageGetAtricleDetail() {
		global $_W,$_GPC;
		$aid = (int)($_GPC['aid'] ?? 0);
		if ($aid < 0) {
			return $this->result(1, "文章不存在");
		}
		
		$sql = "SELECT cdat,likenum,readnum,content FROM ims_sc_blog_articles WHERE id={$aid}";
		$relData = pdo_fetch($sql);
		if ($relData) {
			$data = [
				'createTime'=>date("Y-m-d", $relData['cdat']),
				'readNum'=>$relData['readnum'],
				'zanNum'=>$relData['likenum'],
				'showContent'=>$relData['content']
			];
			return $this->result(0, '', $data);
		} else {
			return $this->result(1, "文章不存在");
		}
	}
}