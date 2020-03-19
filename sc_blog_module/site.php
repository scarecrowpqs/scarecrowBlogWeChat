<?php
/**
 * sc_blog模块微站定义
 *
 * @author isuoge
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Sc_blogModuleSite extends WeModuleSite {
	protected function toJson($data) {
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	
	public function doWebArticleManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_W, $_GPC;
		$allBowenType = pdo_fetchall("SELECT * FROM ims_sc_blog_categorys");
		$defaultImg = $_W['siteroot'] . "addons/sc_blog/template/images/default_fm.jpg";
		include_once $this->template('article/index');
	}
	
	public function doWebWeiYuManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_W, $_GPC;
		include_once $this->template('weiyu/index');
	}
	
	public function doWebFrendLinkManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_W, $_GPC;
		$allFenLei = pdo_fetchall("SELECT * FROM ims_sc_blog_links WHERE spread_id=0");
		include_once $this->template('frendlink/index');
	}
	
	public function doWebMsgManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_W, $_GPC;
		include_once $this->template('msg/index');
	}
	
	public function doWebUserManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_W, $_GPC;
		$userContent = pdo_fetch("SELECT * FROM ims_sc_blog_users WHERE is_admin=1 LIMIT 1");
		$defaultImg = $_W['siteroot'] . "addons/sc_blog/template/images/default_fm.jpg";
 		include_once $this->template('user/index');
	}
	
	/*********************************************微语管理*******************************************/
	
	/**
	 * 编辑微语页面
	 *
	 * @return void
	 */
	public function doWebEditWeiYu() {
		global $_W, $_GPC;
		$id = (int)($_GPC['id'] ?? 0);
		if ($id < 1) {
			die("该条微语不存在");
		}
		
		$weiYuContentSql = "SELECT * FROM ims_sc_blog_weiyu WHERE id={$id}";
		$weiYuContent = pdo_fetch($weiYuContentSql);
		
		
		include_once $this->template('weiyu/edit');
	}

	/**
	 * 添加微语接口
	 *
	 * @return void
	 */
	public function doWebAddWeiYuApi() {
		global $_W, $_GPC;
		$weiyuContent = $_GPC['weiyuContent'] ?? "";
		$isGK = (int)($_GPC['isGk'] ?? 0);
		$iCnt = pdo_insert('ims_sc_blog_weiyu',[
            'content'   =>  $weiyuContent,
            'status'    =>  $isGK,
            'cdat'      =>  time()
        ]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'添加成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'添加失败'
			]);
        }
	}
	
	/**
	 * 编辑微语接口
	 *
	 * @return void
	 */
	public function doWebEditWeiYuApi() {
		global $_W, $_GPC;
		$weiyuContent = $_GPC['weiyuContent'] ?? "";
		$isGK = (int)($_GPC['isGk'] ?? 0);
		$id = (int)($_GPC['id'] ?? 0);
		$iCnt = pdo_update('ims_sc_blog_weiyu',[
            'content'   =>  $weiyuContent,
            'status'    =>  $isGK
        ],['id'=>$id]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'修改成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'修改失败'
			]);
        }
	}
	
	/**
	 * 获取微语列表API
	 *
	 * @return void
	 */
	public function doWebGetWeiYuListPageApi() {
		global $_W, $_GPC;
		$page = (int)($_GPC['page'] ?? 1);
		$limit = (int)($_GPC['limit'] ?? 10);
        $searchContent = addslashes($_GPC['sc'] ?? "");

		$indexIcnt = ($page - 1) * $limit;
        if ($searchContent) {
			$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_weiyu WHERE content like '%{$searchContent}%'";
        } else {
			$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_weiyu;";
		}
		
		$num = pdo_fetch($numSql)['num'];

        if ($num < 1) {
            return [
                'total' =>  0,
                'data'  =>  [],
            ];
        }

        if ($searchContent) {
			$objListSql = "SELECT * FROM ims_sc_blog_weiyu WHERE content like '%{$searchContent}%' ORDER BY cdat DESC LIMIT {$indexIcnt},{$limit}";
        } else {
			$objListSql = "SELECT * FROM ims_sc_blog_weiyu ORDER BY cdat DESC LIMIT {$indexIcnt},{$limit}";
		}
		
		$objList = pdo_fetchall($objListSql);

        $data = [];
        foreach ($objList as $item) {
            $data[] = [
                'id'    =>  $item['id'],
                'content'   =>  $item['content'],
                'status'    =>  $item['status'] == 1 ? '显示' : '隐藏',
                'cdat'      =>  date('Y-m-d H:i:s', $item['cdat'] ? : time())
            ];
        }

        return $this->toJson([
            'status'    =>  'YES',
            'info'      =>  '获取成功',
            'total'     =>  $num,
            'data'      =>  $data
		]);
	}
	
	/**
	 * 删除微语接口
	 *
	 * @return void
	 */
	public function doWebDeleteWeiYuApi() {
		global $_W, $_GPC;
		$id = (int)($_GPC['id'] ?? 0);
		$iCnt = pdo_delete('ims_sc_blog_weiyu', ['id'=>$id]);
		
        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'删除失败'
			]);
        }
	}
	/****************************************************END************************************/
	
	/****************************************************留言设置************************************/
	/**
	 * 获取所有留言分页列表数据API
	 *
	 * @return void
	 */
	public function doWebGetMsgListDataApi() {
		global $_W, $_GPC;
		$page = (int)($_GPC['page'] ?? 1);
		$limit = (int)($_GPC['limit'] ?? 10);

		$indexIcnt = ($page - 1) * $limit;
		$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_comments;";
		
		$num = pdo_fetch($numSql)['num'];

        if ($num < 1) {
            return [
                'total' =>  0,
                'data'  =>  [],
            ];
        }

		$objListSql = "SELECT t2.nickname,t1.content,t1.cdat,t1.is_open,t1.id FROM ims_sc_blog_comments t1 LEFT JOIN ims_mc_mapping_fans t2 ON t1.uid=t2.uid ORDER BY cdat DESC LIMIT {$indexIcnt},{$limit}";
		
		$objList = pdo_fetchall($objListSql);

        $data = [];
        foreach ($objList as $item) {
            $data[] = [
                'id'    	=>  $item['id'],
                'content'   =>  $item['content'],
                'state'    =>  $item['is_open'],
				'cdat'      =>  date('Y-m-d H:i:s', $item['cdat'] ? : time()),
				'nickname'	=>	$item['nickname']
            ];
        }

        return $this->toJson([
            'status'    =>  'YES',
            'info'      =>  '获取成功',
            'total'     =>  $num,
            'data'      =>  $data
		]);
	}
	
	/**
	 * 改变留言状态
	 *
	 * @return void
	 */
	public function doWebChangeMsgStateApi() {
		global $_W, $_GPC;
		$id = $_GPC['id'] ?? 0;
		$obj = pdo_fetch("SELECT id,is_open FROM ims_sc_blog_comments WHERE id={$id}");
		if (!$obj) {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'留言未找到'
			]);	
		}
		$iCnt = pdo_update('ims_sc_blog_comments', ['is_open'=>$obj['is_open'] == 0 ? 1 : 0], ['id'=>$id]);
		if ($iCnt) {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'修改成功'
			]);	
		} else {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'修改失败'
			]);	
		}
	}
	
	/**
	 * 删除留言API
	 *
	 * @return void
	 */
	public function doWebDeleteMsgApi() {
		global $_W, $_GPC;
		$id = $_GPC['id'] ?? 0;
		$iCnt = pdo_delete("ims_sc_blog_comments", ['id'=>$id]);
		if ($iCnt) {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除成功'
			]);	
		} else {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除失败'
			]);	
		}
	}
	/****************************************************END****************************************/
	
	/*********************************************友链管理*******************************************/
	/**
	 * 添加友链接口
	 *
	 * @return void
	 */
	public function doWebAddFrendLinkApi() {
		global $_W, $_GPC;
		$linkName = $_GPC['linkName'] ?? "";
		$linkUrl = $_GPC['linkUrl'] ?? "";
		$imageUrl = $_GPC['imageUrl'] ?? "";
		$linkJieShao = $_GPC['linkJieShao'] ?? "";
		$linkGroup = (int)($_GPC['linkGroup'] ?? 0);
		$iCnt = pdo_insert('ims_sc_blog_links',[
            'title'   =>  $linkName,
            'url'     =>  $linkUrl,
            'pic'     =>  $imageUrl,
            'texts'     =>  $linkJieShao,
            'spread_id'     =>  $linkGroup,
            'status'     => 1,
            'cdat'      =>  time()
        ]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'添加成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'添加失败'
			]);
        }
	}
	
	/**
	 * 获取所有友链列表
	 *
	 * @return void
	 */
	public function doWebGetFrendLinkListApi() {
		global $_W, $_GPC;
		$page = (int)($_GPC['page'] ?? 1);
		$limit = (int)($_GPC['limit'] ?? 10);
        $searchContent = addslashes($_GPC['sc'] ?? "");

		$indexIcnt = ($page - 1) * $limit;
        if ($searchContent) {
			$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_links WHERE title like '%{$searchContent}%'";
        } else {
			$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_links;";
		}
		
		$num = pdo_fetch($numSql)['num'];

        if ($num < 1) {
            return [
                'total' =>  0,
                'data'  =>  [],
            ];
        }

        if ($searchContent) {
			$objListSql = "SELECT * FROM ims_sc_blog_links WHERE title like '%{$searchContent}%' ORDER BY cdat DESC LIMIT {$indexIcnt},{$limit}";
        } else {
			$objListSql = "SELECT * FROM ims_sc_blog_links ORDER BY cdat DESC LIMIT {$indexIcnt},{$limit}";
		}
		
		$objList = pdo_fetchall($objListSql);

        $data = [];
        foreach ($objList as $item) {
            $data[] = [
                'id'    =>  $item['id'],
                'title'   =>  $item['title'],
                'url'   =>  $item['url'],
                'pic'   =>  $item['pic'],
                'texts'   =>  $item['texts'],
                'sort'   =>  $item['sort'],
                'spread_id'   =>  $item['spread_id'],
                'status'    =>  $item['status'] == 1 ? '显示' : '隐藏'
            ];
        }

        return $this->toJson([
            'status'    =>  'YES',
            'info'      =>  '获取成功',
            'total'     =>  $num,
            'data'      =>  $data
		]);
	}
	
	/**
	 * 删除友链接口
	 *
	 * @return void
	 */
	public function doWebDeleteFrendLinkApi() {
		global $_W, $_GPC;
		$id = $_GPC['id'] ?? 0;
		$iCnt = pdo_delete("ims_sc_blog_links", ['id'=>$id]);
		if ($iCnt) {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除成功'
			]);	
		} else {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除失败'
			]);	
		}
	}
	
	/**
	 * 编辑友链页面
	 *
	 * @return void
	 */
	public function doWebEditFrendLinkPage() {
		global $_W, $_GPC;
		$id = (int)($_GPC['id'] ?? 0);
		if ($id < 1) {
			die("该条友链不存在");
		}
		
		$frendLinkContentSql = "SELECT * FROM ims_sc_blog_links WHERE id={$id}";
		$rendLinkContent = pdo_fetch($frendLinkContentSql);
		$allFenLei = pdo_fetchall("SELECT * FROM ims_sc_blog_links WHERE spread_id=0");
		
		include_once $this->template('frendlink/edit');
	}
	
	/**
	 * 修改友链API
	 *
	 * @return void
	 */
	public function doWebUpdateFrendLinkApi() {
		global $_W, $_GPC;
		$linkName = $_GPC['linkName'] ?? "";
		$linkUrl = $_GPC['linkUrl'] ?? "";
		$imageUrl = $_GPC['imageUrl'] ?? "";
		$linkJieShao = $_GPC['linkJieShao'] ?? "";
		$linkGroup = (int)($_GPC['linkGroup'] ?? 0);
		$sort = (int)($_GPC['sort'] ?? 0);
		$status = (int)($_GPC['status'] ?? 0);
		$id = (int)($_GPC['id'] ?? 0);
		$iCnt = pdo_update('ims_sc_blog_links',[
            'title'   =>  $linkName,
            'url'     =>  $linkUrl,
            'pic'     =>  $imageUrl,
            'texts'     =>  $linkJieShao,
            'spread_id'     =>  $linkGroup,
            'status'     => $status,
            'sort'     => $sort
        ], ['id'=>$id]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'修改成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'修改失败'
			]);
        }
	}
	/****************************************************END****************************************/
	
	/****************************************************发布博文****************************************/	
	/**
	 * 上传图片文件
	 *
	 * @return void
	 */
	public function doWebUploadImgFileApi() {
		global $_W, $_GPC;
		load()->func('file');
		return $this->toJson(file_upload($_FILES['upfile'], 'image'));
	}
	
	/**
	 * 发布博文接口
	 *
	 * @return void
	 */
	public function doWebAddArticleApi() {
		global $_W, $_GPC;
		$articleTitle = $_GPC['articleTitle'] ?? "";
		$articleUser = $_GPC['articleUser'] ?? "";
		$articleZhaiyao = $_GPC['articleZhaiyao'] ?? "";
		$articleContent = $_GPC['articleContent'] ?? "";
		$imgUrl = $_GPC['imgUrl'] ?? "";
		$description = $_GPC['description'] ?? "";
		$keyword = $_GPC['keyword'] ?? "";
		$categoryId = (int)($_GPC['categoryId'] ?? 0);
		$isGk = (int)($_GPC['isGk'] ?? 0);
		$isTj = (int)($_GPC['isTj'] ?? 0);
		$readNum = (int)($_GPC['readNum'] ?? 0);
		
		$iCnt = pdo_insert('ims_sc_blog_articles',[
			'cid'	=>	$categoryId,
			'title'	=>	$articleTitle,
			'keyword'	=>	$keyword,
			'description'	=>	$description,
			'readnum'	=>	$readNum,
			'author'	=>	$articleUser,
			'remark'	=>	$articleZhaiyao,
			'content'	=>	$articleContent,
			'openlevel'	=>	$isGk,
			'recommend'	=>	$isTj,
			'imgurl'	=>	$imgUrl,
			'uid'		=>	1,
			'cdat'		=>	time(),
			'udat'		=>	time()
        ]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'发布成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'发布失败'
			]);
        }
	}
	
	/**
	 * 获取博文列表接口
	 *
	 * @return void
	 */
	public function doWebGetBowenListApi() {
		global $_W, $_GPC;
		$page = (int)($_GPC['page'] ?? 1);
		$limit = (int)($_GPC['limit'] ?? 10);
        $searchContent = addslashes($_GPC['sc'] ?? "");

		$indexIcnt = ($page - 1) * $limit;
        if ($searchContent) {
			$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_articles WHERE title like '%{$searchContent}%'";
        } else {
			$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_articles;";
		}
		
		$num = pdo_fetch($numSql)['num'];

        if ($num < 1) {
			return $this->toJson([
				'status'    =>  'YES',
				'info'      =>  '获取成功',
				'total'     =>  0,
				'data'      =>  []
			]);
        }

        if ($searchContent) {
			$objListSql = "SELECT t1.*,t2.title as cateName FROM ims_sc_blog_articles  t1 LEFT JOIN ims_sc_blog_categorys t2 ON t1.cid=t2.cid WHERE t1.title like '%{$searchContent}%' ORDER BY cdat DESC LIMIT {$indexIcnt},{$limit}";
        } else {
			$objListSql = "SELECT t1.*,t2.title as cateName FROM ims_sc_blog_articles  t1 LEFT JOIN ims_sc_blog_categorys t2 ON t1.cid=t2.cid ORDER BY cdat DESC LIMIT {$indexIcnt},{$limit}";
		}
		
		$objList = pdo_fetchall($objListSql);

        $data = [];
        foreach ($objList as $item) {
            $data[] = [
                'id'    =>  $item['id'],
                'cateName'   =>  $item['cateName'],
                'title'   =>  $item['title'],
                'createTime'   =>  date("Y-m-d H:i:s", $item['cdat']),
                'author'   =>  $item['author']
            ];
        }

        return $this->toJson([
            'status'    =>  'YES',
            'info'      =>  '获取成功',
            'total'     =>  $num,
            'data'      =>  $data
		]);
	}
	
	/**
	 * 删除博文
	 *
	 * @return void
	 */
	public function doWebDeletBowenDataApi() {
		global $_W, $_GPC;
		$id = $_GPC['id'] ?? 0;
		$iCnt = pdo_delete("ims_sc_blog_articles", ['id'=>$id]);
		if ($iCnt) {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除成功'
			]);	
		} else {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除失败'
			]);	
		}
	}
	
	/**
	 * 显示编辑博文页面
	 *
	 * @return void
	 */
	public function doWebEditBowenPage() {
		global $_W, $_GPC;
		$id = $_GPC['id'] ?? 0;
		$allBowenType = pdo_fetchall("SELECT * FROM ims_sc_blog_categorys");
		$allBowenContent = pdo_fetch("SELECT * FROM ims_sc_blog_articles WHERE id={$id}");
		$defaultImg = $_W['siteroot'] . "addons/sc_blog/template/images/default_fm.jpg";	
		include_once $this->template('article/edit');
	}
	
	/**
	 * 修改博文接口
	 *
	 * @return void
	 */
	public function doWebUpdateBowenApi() {
		global $_W, $_GPC;
		$articleTitle = $_GPC['articleTitle'] ?? "";
		$articleUser = $_GPC['articleUser'] ?? "";
		$articleZhaiyao = $_GPC['articleZhaiyao'] ?? "";
		$articleContent = $_GPC['articleContent'] ?? "";
		$imgUrl = $_GPC['imgUrl'] ?? "";
		$description = $_GPC['description'] ?? "";
		$keyword = $_GPC['keyword'] ?? "";
		$categoryId = (int)($_GPC['categoryId'] ?? 0);
		$isGk = (int)($_GPC['isGk'] ?? 0);
		$isTj = (int)($_GPC['isTj'] ?? 0);
		$readNum = (int)($_GPC['readNum'] ?? 0);
		$id = (int)($_GPC['id'] ?? 0);
		
		$iCnt = pdo_update('ims_sc_blog_articles',[
			'cid'	=>	$categoryId,
			'title'	=>	$articleTitle,
			'keyword'	=>	$keyword,
			'description'	=>	$description,
			'readnum'	=>	$readNum,
			'author'	=>	$articleUser,
			'remark'	=>	$articleZhaiyao,
			'content'	=>	$articleContent,
			'openlevel'	=>	$isGk,
			'recommend'	=>	$isTj,
			'imgurl'	=>	$imgUrl,
			'uid'		=>	1,
			'cdat'		=>	time(),
			'udat'		=>	time()
        ],['id'=>$id]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'修改成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'修改失败'
			]);
        }
	}
	/****************************************************END****************************************/
	
	/****************************************************个人管理************************************/
	/**
	 * 更新用户个人信息
	 *
	 * @return void
	 */
	public function doWebUpdateUserApi() {
		global $_W, $_GPC;
		$nickName = $_GPC['nickName'] ?? "";
		$imageUrl = $_GPC['imageUrl'] ?? "";
		$userSex = (int)($_GPC['userSex'] ?? 0) == 1 ? : 0;
		$id = (int)($_GPC['id'] ?? 0);
		
		if (empty($nickName)) {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'昵称不能为空'
			]);
		}
		
		if (empty($imageUrl)) {
			$imageUrl = $_W['siteroot'] . "addons/sc_blog/template/images/default_fm.jpg"; 
		}
		
		$iCnt = pdo_update('ims_sc_blog_users',[
			'nickname'	=>	$nickName,
			'imgurl'	=>	$imageUrl,
			'sex'		=>	$userSex
        ],['id'=>$id]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'修改个人信息成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'修改个人信息失败'
			]);
        }
	}
	
	/**
	 * 添加作品数据
	 *
	 * @return void
	 */
	public function doWebAddWorksDataApi() {
		global $_W, $_GPC;
		$workName = $_GPC['workName'] ?? "";
		$workJieShao = $_GPC['workJieShao'] ?? "";
		$workToHref = $_GPC['workToHref'] ?? "";
		$imageUrl = $_GPC['imageUrl'] ?? "";
		
		if (empty($imageUrl)) {
			$imageUrl = $_W['siteroot'] . "addons/sc_blog/template/images/default_fm.jpg"; 
		}
		
		$iCnt = pdo_insert('ims_sc_blog_works',[
            'name'   =>  $workName,
            'img_href'     =>  $imageUrl,
            'introduce'     =>  $workJieShao,
            'to_href'     =>  $workToHref
        ]);

        if ($iCnt) {
            return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'添加作品成功'
			]);
        } else {
			return $this->toJson([
				'status'	=>	'NO',
				'info'		=>	'添加作品失败'
			]);
        }
	}
	
	/**
	 * 获取所有作品列表API
	 *
	 * @return void
	 */
	public function doWebGetWorksListApi() {
		global $_W, $_GPC;
		$page = (int)($_GPC['page'] ?? 1);
		$limit = (int)($_GPC['limit'] ?? 10);

		$indexIcnt = ($page - 1) * $limit;
		$numSql = "SELECT COUNT(id) as num FROM ims_sc_blog_works;";
		
		$num = pdo_fetch($numSql)['num'];

        if ($num < 1) {
            return [
                'total' =>  0,
                'data'  =>  [],
            ];
        }

		$objListSql = "SELECT * FROM ims_sc_blog_works LIMIT {$indexIcnt},{$limit}";
		
		$objList = pdo_fetchall($objListSql);

        $data = [];
        foreach ($objList as $item) {
            $data[] = [
                'id'    	=>  $item['id'],
                'workName'   =>  $item['name'],
                'imgHref'    =>  $item['img_href'],
				'toHref'	=>	$item['to_href'],
				'introduce'	=>	$item['introduce']
            ];
        }

        return $this->toJson([
            'status'    =>  'YES',
            'info'      =>  '获取成功',
            'total'     =>  $num,
            'data'      =>  $data
		]);
	}
	
	/**
	 * 删除作品API
	 *
	 * @return void
	 */
	public function doWebDeleteWorkApi() {
		global $_W, $_GPC;
		$id = $_GPC['id'] ?? 0;
		$iCnt = pdo_delete("ims_sc_blog_works", ['id'=>$id]);
		if ($iCnt) {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除作品成功'
			]);	
		} else {
			return $this->toJson([
				'status'	=>	'YES',
				'info'		=>	'删除作品失败'
			]);	
		}
	}
	/****************************************************END****************************************/
}