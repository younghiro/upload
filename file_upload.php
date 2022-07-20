<?php 
//ファイル取得関連
$file = $_FILES['img'];

$filename = $file['name'];
$tmp_path = $file['tmp_name'];
$file_error= $file['error'];
$filesize = $file['size'];

/*サニタイズは主にWeb上で行う処理のことで、サイバー攻撃につながるような文字を無効化することを指します。*/
/*POST や GET などの外部からの変数を、フィルターして無害な値にしてくれたり、弾いてくれる。*/

//キャプションを取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

//キャプションのバリデーション
//未入力
if(empty($caption)){
    echo 'キャプションを入力してください。';
    echo '<br>';
}
//140文字
if(strlen($caption)>140){
    echo 'キャプションは140文字以内で入力してください。';
    echo '<br>';
}

//ファイルのバリデーション
//ファイルサイズが１MB未満か
if($filesize> 1048576 || $file_error ==2){
    echo'ファイルサイズは１MB未満にしてください。';
    echo '<br>';
}

//拡張は画像形式か
$allow_ext = array('jpg' , 'jpeg' ,'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array(strtolower($file_ext), $allow_ext)){
    echo '画像ファイルを添付してください。';
    echo '<br>';
}

//ファイルがあるかどうか
if(is_uploaded_file($tmp_path)){
    echo $filename.'をアップしました。';
}else{
    echo 'ファイルが選択されてません。';
}
echo '<br>';

/*pathinfo($filename,PATHINFO_EXTENSION)ファイルの拡張子を得る*/
/*in_array(探されるもの,配列)配列の中にあったらtrue*/
/*strtolower全部小文字に治す*/
/*is_uploaded_fileファイルがあるかどうか*/
?>
<a href="./upload_form.php">戻る</a>