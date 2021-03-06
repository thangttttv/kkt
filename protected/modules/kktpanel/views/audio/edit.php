﻿<?php
    $url = new Url(); 
    $forder_upload = "audio";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;
    //$link_url = "http://".$_SERVER["HTTP_HOST"].":8000/upload/upload_base.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
    $arr_status = LoadConfig::$status;
?>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var configUploadData = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:"<?php echo $data['create_date']; ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:"<?php echo $data['create_date']; ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.mp3;", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUpload(configUploadData); 
        configUploadOther(configUploadDataOther);   
    };     
    function uploadResponse(serverData){  
        try {
            $("#txtFileName").val(""); 
            var response = $.parseJSON(serverData); // eval( "(" + serverData + ")" );      
            if(response.code==404){
                alert(response.message);return false;
            }  
            var filename = response.filename;    
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;
            var type_size = $("picture_320_240").val();

            $("#picture_240_320").val(filename);
            $("#show_pic_240_320").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:240px;height:320px" alt="pic">');

        } catch (e) {

        };
    }
    function uploadResponseOther(serverData){  
        try {
            $("#txtFileName_other").val(""); 

            var response = $.parseJSON(serverData);      
            if(response.code==404){
                alert(response.message);return false;
            }  
            var filename = response.filename;    
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;  
            //var str_filename = $("#file_audio").val() + ';' + filename;
            $("#file_audio").val(filename);
            var link_video = '<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'';
            $("#show_file").html('Tên file Audio: <strong>' + filename + '</strong>');
            /*var html_video = setHtmlVideo(link_video,400,300);
            $("#mediaplayer").html(html_video);*/
        } catch (e) {

        };
    }

    function ajaxUpdateAudio(){
        var appId =0;
        $("input[name=appId]:checked").each(function(){
            appId = parseInt(this.value) + appId;
        });
        var arr = $.map($('input[name=opt]:checkbox:checked'), function(e,i) {
            return +e.value;
        });
        var id = '<?php echo $data["id"]?>';
        var title_audio = $("#title_audio").val();
        var chapter = $("#chapter").val();
        var author = $("#author").val();
        var reader = $("#reader").val();
        var picture = $("#picture").val();
        var description = $("#description").val();
        var status = $("#status").val();
        var strUrl = "<?=$url->createUrl("audio/ajaxUpdateAudio") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                title_audio:title_audio,
                author:author,
                reader:reader,
                chapter:chapter,
                arr:arr,
                picture_240_320:$("#picture_240_320").val(),
                description:description,
                status:status,
                price:$("#price").val(),
                appId:appId,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Cập nhật thành công');
                    window.location = '<?php echo $url->createUrl("audio/index")?>';
                }else{
                    $("#show_error").html(msg);
                }
            },
            beforeSend:function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_save").removeAttr("disabled"); 
            }          
        });
    }
    function ajaxUpdateAudioDetail(){

        var id = $("#audio_detail_id").val();
        var story_audio_id = $("#story_audio_id").val();
        var file_audio = $("#file_audio").val();
        var file_audio_ftp = $("#file_audio_ftp").val();
        var title_chapter = $("#title_chapter").val();
        var size = $("#size").val();
        var duration = $("#duration").val();
        var upload = $("#upload").val();
        var strUrl = "<?=$url->createUrl("audio/ajaxUpdateAudioDetail") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                story_audio_id:story_audio_id,
                upload:upload,
                file_audio:file_audio,
                file_audio_ftp:file_audio_ftp,
                title_chapter:title_chapter,
                size:size,
                duration:duration,
            },
            success: function(msg){
                $("#table").html(msg);
            }

        });
    }
    function ajaxSaveAudioDetail(){

        var id = '<?php echo $data["id"]?>';
        var file_audio = $("#file_audio").val();
        var file_audio_ftp = $("#file_audio_ftp").val();
        var title_chapter = $("#title_chapter").val();
        var size = $("#size").val();
        var duration = $("#duration").val();
        var upload = $("#upload").val();
        var create_date = "<?php echo $data['create_date'] ?>";
        var strUrl = "<?=$url->createUrl("audio/ajaxSaveAudioDetail") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                upload:upload,
                file_audio:file_audio,
                file_audio_ftp:file_audio_ftp,
                title_chapter:title_chapter,
                size:size,
                duration:duration,
                create_date:create_date
            },
            success: function(msg){
                $("#table").html(msg);
            }

        });
    }
    function ajaxGetEditAudioDetail(id){
        var upload = $("#upload").val();
        var strUrl = "<?=$url->createUrl("audio/ajaxGetEditAudioDetail") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                upload:upload,
                id:id,
            },
            success: function(msg){
                $("#data_edit").html(msg);
            }
        });
    }
    function ajaxDeleteAudioDetail(id,content_id){
        var strUrl = "<?=$url->createUrl("audio/ajaxDeleteAudioDetail") ?>";
        if(confirm('Bạn có chắc muốn xóa audio này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                    id:id,
                    content_id:content_id
                },
                success: function(msg){
                    $("#table").html(msg);
                }          
            });
        }
    }
</script>

<div class="main clearfix">
    <div class="box clearfix bottom30">  

        <div class="col-570">  
            <div clas = "box">
                <ul class="form">
                    <li class="clearfix"><label><strong>Tên Audio </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['title']; ?>" id="title_audio"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Tác giả </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['author'] ?>" id="author"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Người đọc </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['reader'] ?>" id="reader"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Danh mục </strong>:</label>
                        <div class="filltext">
                            <?php foreach($data_cat as $key=>$value){?>
                                <input name="opt" type="checkbox" value="<?php echo $key;?>" <?php if(isset($check[$key])){echo $check[$key]== $key ? "checked='checked'" :"" ;} ?>><?php echo $value;?>
                                <?php }?>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>App su dung</strong>:</label>
                        <div class="filltext">
                            <?php foreach($arr_app as $key=>$value){ ?>
                                <input type="checkbox" name="appId" value="<?php echo $key?>" <?php echo ($data["app_ids"] & $key=$key) ? 'checked':''; ?>/><?php echo $value;?>
                                <?php }?>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Giá</strong>:</label>
                        <div class="filltext">
                            <select id="price">
                                <?php foreach(LoadConfig::$price_content as $key=>$value){?>
                                    <option value="<?php echo $value;?>" <?php echo $value == $data["price"] ? 'selected="selected"':''?>><?php echo $value;?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Số chương</strong>:</label>
                        <div class="filltext">
                            <input type="text" id="chapter" name="chapter" value="<?php echo $data['c_chapter']; ?>" style="border:1px solid #DFDFDF; width: 80px;"/> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="status">
                                <?php foreach($arr_status as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php echo $key == $data["status"] ? 'selected="selected"':''?>><?php echo $value?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Ảnh minh họa </strong>:</label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName" readonly="readonly"/>
                                <input type="text" id="urlFile" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder"></span>
                            </p>

                            <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress">
                                <span class="legend">File upload</span>
                            </div>

                            <input type="hidden" id="picture" value="<?php echo $data['image'];?>"/>
                            <p id="show_pic">Tên Ảnh: <strong><?php echo $data['image'];?> </p>
                            <input type="hidden" id="picture_320_240" value="<?php echo $data['image'];?>"/>
                            <p id="show_pic_320_240"></p>
                            <input type="hidden" id="picture_240_320" value="<?php echo $data["image"];?>"/>
                            Ảnh 240x320: <p id="show_pic_240_320"><img style="width:240px;height:320px" src="<?php echo Common::getImage($data["image"],"audio",$data["create_date"])?>"/></p>

                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Tóm tắt</strong>:</label>
                        <div class="filltext">
                            <textarea cols="5" rows="5" style="width:420px; height:120px" id="description"><?php echo $data['description'] ?></textarea>
                        </div>
                    </li>

                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxUpdateAudio();" type="button" value=" Cập nhật " class="btn-bigblue"> 
                            &nbsp;
                            <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                        </div>
                    </li>
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext" style="color: red;" id="show_error"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col5">&nbsp;</div>
        <div class ="col-570">
            <div class="box">
                <div class="Tabs clearfix">
                    <ul class="clearfix">
                        <li id="upload" value="0"><a onclick="activeUploadType(1)" href="javascript:void(0)" class="active"  id="type_ftp" class=""><span>&nbsp; Upload FTP &nbsp;</span></a></li>
                        <li id="upload" value="1"><a onclick="activeUploadType(0)" href="javascript:void(0)" id="type_upload"><span>&nbsp; Upload File &nbsp;</span></a></li>

                    </ul>
                    <input type="hidden" id="type_game" value="0"/>
                </div>
                <ul class="form" id="form1">
                    <!--<div id="data_edit_upload">-->
                    <div id="data_edit">
                        <li id="file_audio_name" class="clearfix" ><label><strong>Tên file</strong>:</label>
                            <div class="filltext">
                                <input style="width:360px" type="text" value="" id="file_audio_ftp"/>
                            </div>
                        </li>
                        <li class="clearfix"><label><strong>Tiêu đề chương</strong>:</label>
                            <div class="filltext">
                                <input style="width:360px" type="text" value="" id="title_chapter"/>
                            </div>
                        </li>
                        <li class="clearfix"><label><strong>Thời gian</strong>:</label>
                            <div class="filltext">
                                <input style="width:360px" type="text" value="" id="duration"/> (hh:mm:ss)
                            </div>
                        </li>
                        <li class="clearfix"><label><strong>Dung lượng</strong>:</label>
                            <div class="filltext">
                                <input style="width:360px" type="text" value="" id="size"/> 
                                <input type="hidden" id="audio_detail_id" value="">
                                <input type="hidden" id="story_audio_id" value="">
                            </div>
                        </li>
                    </div>
                    <li id = "li1" class="clearfix" style="display: none;"><label><strong>Upload Audio</strong></label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                                <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other"></span>
                            </p> 
                            <!--<p><i>Định dạng file: *.mp4;*.wmv;*.avi;*.flv(Dung lượng ko được quá 20 MB)</i></p>-->
                            <p><i>Định dạng file: *.mp3;(Dung lượng ko được quá 20 MB)</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress_other">
                                <span class="legend">File upload</span>
                            </div>
                            <input type="hidden" id="file_audio" value="<?php if(isset($file_name['file'])){echo $file_name['file'];}?>"/>
                            <p id="show_file"> Tên File Audio: <strong><?php if(isset($file_name['file'])){echo $file_name['file'];}?></p> 
                        </div>
                    </li>
                    <!--</div>-->
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input  onclick="ajaxSaveAudioDetail();" type="button" value="Thêm mới" class="btn-bigblue"> 
                            &nbsp;
                            <input  onclick="ajaxUpdateAudioDetail();" type="button" value=" Cập nhật " class="btn-bigblue"> 
                            &nbsp;
                        </div>
                    </li>
                    <br/>
                </ul>
            </div>
            <div id="table">
                <div class="table clearfix">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr class="bg-grey">
                                <td width="5%"><strong>STT</strong></td>
                                <td width="10%"><strong>Tên chương/Tên File</strong></td>
                                <td width="11%"><strong>Duration</strong></td>
                                <td width="5%"><strong>Size</strong></td>
                                <td width="10%"><strong>Hành động</strong></td>

                            </tr>
                            <?php foreach($file_name as $key1=>$value1){$key1+=1;?>
                                <tr>
                                    <td class="middle"><?php echo $key1."</br>_</br>".$value1["id"]?></td>
                                    <td><?php echo $value1["title"]."/</br>".$value1["file"] ;?></td>
                                    <td><?php echo $value1["duration"];?></td>
                                    <td><?php echo  $value1["size"];?></td>
                                    <td>
                                        <a class="s14" href="javascript:void(0)" onclick="ajaxGetEditAudioDetail('<?php echo $value1["id"]?>')"> Sửa </a> | 
                                        <a href="javascript:void(0)" onclick="ajaxDeleteAudioDetail('<?php echo $value1["id"]?>','<?php echo $value1["story_audio_id"]?>')">  Xóa  </a> |
                                    </td>
                                </tr>
                                <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->params['static_url_cp']; ?>/js/mediaplayer/jwplayer.js"></script>
<script type="">
    function activeUploadType(type){
        if(type==1){
            $("#li1").hide("slow");
            $("#file_audio_name").show("slow");
            document.getElementById('upload').value = '0';
            $("#type_upload").removeClass('active');
            $("#type_ftp").addClass('active');    
        }else{
            $("#li1").show("slow");
            $("#file_audio_name").hide("slow");
            document.getElementById('upload').value = '1';
            $("#type_ftp").removeClass('active');
            $("#type_upload").addClass('active');
        }
        $("#upload_type").val(type);
    }
</script>