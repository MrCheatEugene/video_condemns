<h2>Сделать ролик как у @broton_ (судно+жириновский)</h1>
<h4>Пароль можно получить написав в ЛС мне на почту admin@mrcheat.ga или в тикток @emilmrcheat </h2>
<style type="text/css">
	body{
		font: 20px Arial;
	}
</style>
<form method="POST" enctype="multipart/form-data">
	Файл <input type="file" name="video">
	<br>Пароль <input type="text" name="password">
	<input type="submit" name="">
</form>

<?php

if(empty($_FILES)==false and empty($_FILES['video']) == false and  empty($_POST['password']) == false and $_POST['password'] ="o32hr7876^&%&^%B23673F"){
if ($_FILES['video']['error'] == 0 and $_FILES['video']['type'] =="video/mp4") {
	if (file_exists("video.mp4")) {
		if(unlink("video.mp4")==false){
			die("Не удалось удалить временный файл. У меня нет прав.");
		}
	}
	move_uploaded_file($_FILES['video']['tmp_name'], "video.mp4");
	exec('ffmpeg -i video.mp4 -i jirinovsky.mp4 -filter_complex "[1:v]scale=iw/1:-1[cam];[0:v][cam]overlay=main_w-overlay_w-5:main_h-overlay_h-5;[0:a][1:a]amix" -y output.mp4',$res);
	/* я для себя вот тут оставил просто, можешь почитать потыкать посмотреть если интересно
	//exec('ffmpeg.exe -i video.mp4 -i jirinovsky.mp4 -i sudno.mp3 -filter_complex "[1:v]scale=iw/1:-1[cam];[0:v][cam]overlay=main_w-overlay_w-5:main_h-overlay_h-5;[0:a][1:a]amix" -y -map 0 -map 2 output.mp4',$res);
	*/
	exec('ffmpeg -i output.mp4 -i sudno.wav -filter_complex "[0:a]aformat=fltp:44100:stereo,apad[0a];[1]aformat=fltp:44100:stereo,volume=0.5[1a];[0a][1a]amerge[a]" -map 0:v -map "[a]" -ac 2 -y -to 8 output_t.mp4',$res);
	echo "Видео загружено и обработано. Скачать можно нажав ПКМ по плееру - Скачать.";
	echo '<video width="640" height="480" controls src="output_t.mp4"> </video>';
}else{
	echo "Произошла ошибка ".$_FILES['video']['error'].". Mime-Тип : ".$_FILES['video']['type'];
}
}
