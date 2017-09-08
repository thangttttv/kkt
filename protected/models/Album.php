<?php
class Album extends CActiveRecord
{
	public function getAlbumByCat($cat_id,$cat_alias,$page,$num_per_page)
	{
		$cacheService = new CacheService("Album","getAlbumByCat",$cat_id,$page.$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1';
			$sql='SELECT count(id) as total FROM c_album WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			/*Paging*/
			$num_page=ceil($total/$num_per_page);
			$url=Url::createUrl('kktAlbum/cat',array('cat_id'=>$cat_id,'alias'=>$cat_alias));    
			$url1=$url;
			$url.='/';
			$paging=Paging::show_paging_wap($num_page,$page,$url,$url1);
			$a=array($rows,$paging);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getLatestAlbum($page,$num_per_page)
	{
		$cacheService = new CacheService("Album","getLatestAlbum",$page,$num_per_page);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1';
			$sql='SELECT count(id) as total FROM c_album WHERE '.$sub_sql.'';
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			$total=$row['total'];
			$begin = ($page - 1) * $num_per_page;
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			/*Paging*/
			$num_page=ceil($total/$num_per_page); 
			$url=Url::createUrl('kktAlbum/index').'/';
			$url1=$url;
			$paging=Paging::show_paging_wap($num_page,$page,$url,$url1);
			$a=array($rows,$paging);
			Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$a=$cache;
		}
		return $a;
	}
	public function getImgByAlbum($album_id)
	{
		$cacheService = new CacheService("Album","getImgByAlbum",$album_id);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_image WHERE albumId=".$album_id;
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_86400);
		}
		else
		{
			$rows=$cache;
		}
		return $rows;
	}
	public function getAlbumById($album_id)
	{
		$cacheService = new CacheService("Album","getAlbumById",$album_id);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_album WHERE id=".$album_id." AND status=1";
			$command=$connect->createCommand($sql);
			$row = $command->queryRow();
			Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_86400);
		}
		else
		{
			$row=$cache;
		}
		return $row;
	}
	public function updateHitDownload($album_id)
	{
		$connect =Yii::app()->db;
		$sql="UPDATE c_album SET hit=hit+1 WHERE id=".$album_id;
		$command=$connect->createCommand($sql);
		$result = $command->execute();
		$sql="UPDATE c_data SET hit=hit+1 WHERE dataId=".$album_id." AND type=3";
		$command=$connect->createCommand($sql);
		$result = $command->execute();
		return $result;
	}
	public function genHtmlAlbum($album)
	{
		$html='';
		if($album)
		foreach($album as $row)
		{
			$link_detail=Url::createUrl('kktAlbum/detail',array('alias'=>$row['alias'],'album_id'=>$row['id']));
			$link_download=Url::createUrl('kktAlbum/download',array('album_id'=>$row['id'],'alias'=>$row['alias']));
			$link_img=Common::getImage($row['picture'],'image',$row['create_date'],'m');
			$img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
			if($row['isHot']==1)
			{
				$icon_hot='<img alt="icon hot" class="ic_hot" src="'.Yii::app()->params['static_url'].'/images/icon_hot.gif">';
			}
			else
			{
				$icon_hot='<img alt="icon hot" class="ic_new2" src="'.Yii::app()->params['static_url'].'/images/icon_new2.png">';
			}
			$html.='<tr>
						<td width="52">
							<a href="'.$link_detail.'" title="'.$row['title'].'">
								<img src="'.$link_img.'" alt="'.$row['title'].'" class="img52" onerror="this.src=\''.$img_error.'\'">
							</a>
						</td>
						<td valign="top" class="item_data">
							<a class="ic_pic" href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'
							<br />
                            <span class="cl666">'.$row['introtext'].'</span>
                            <br>
							<a class="cl999 ic_viewing" href="'.$link_detail.'">Xem ngay</a>&nbsp;|&nbsp;
							<a class="download clorage" href="'.$link_download.'">Tải miễn phí</a>
						</td>
					</tr>';
		}
		return $html;
	}
	public function getHotAlbum($limit)
	{
		$cacheService = new CacheService("Album","getHotAlbum",$limit);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isHot=1';
			$sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$limit."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$rows=$cache;
		}
		return $rows;
	}
	public function getHotAlbumByCat($cat_id,$album_id,$limit)
	{
		$cacheService = new CacheService("Album","getHotAlbumByCat",$cat_id.$album_id.$limit);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sub_sql='status=1 AND isHot=1 AND id!='.$album_id.' AND categoryId='.$cat_id;
			$sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_album WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$limit."";
			$command=$connect->createCommand($sql);
			$rows = $command->queryAll();
			Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_900);
		}
		else
		{
			$rows=$cache;
		}
		return $rows;
	}
    public function getLastestAlbumByCat($cat_id,$page,$num_per_page){
            $begin = ($page - 1) * $num_per_page;
            $cacheService = new CacheService("Album","getLastestAlbumByCat",$cat_id,$page.$num_per_page);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album 
                WHERE categoryId=".$cat_id." AND status=1 ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
                $command=$connect->createCommand($sql);
                $row = $command->queryAll();
                Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_86400);
            }
            else
            {
                $row=$cache;
            }
            return $row;
        }
        public function getManyDownloadAlbumByCat($cat_id,$page,$num_per_page){
            $begin = ($page - 1) * $num_per_page;
            $cacheService = new CacheService("Album","getManyDownloadAlbumByCat",$cat_id,$page.$num_per_page);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album 
                WHERE categoryId=".$cat_id." AND status=1 ORDER BY download DESC LIMIT ".$begin.",".$num_per_page."";
                $command=$connect->createCommand($sql);
                $row = $command->queryAll();
                Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_86400);
            }
            else
            {
                $row=$cache;
            }
            return $row;
        }
        public function getDataAlbum($page,$num_per_page){
            $begin = ($page - 1) * $num_per_page;
            $cacheService = new CacheService("Album","getDataAlbum",$page.$num_per_page);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT count(*) as count FROM c_album 
                WHERE 1 AND status=1";
                $command=$connect->createCommand($sql);
                $row = $command->queryRow();
                $num_page=ceil($row["count"]/$num_per_page);
                $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album 
                WHERE 1 AND status=1 ORDER BY id DESC LIMIT ".$begin.",".$num_per_page."";
                $command=$connect->createCommand($sql);
                $row = $command->queryAll();
                $a = array($row,$num_page); 
                Yii::app()->cache->set($key, $a, ConstantsUtil::TIME_CACHE_86400);
            }
            else
            {
                $a=$cache;
            }
            return $a;
        }
}
?>