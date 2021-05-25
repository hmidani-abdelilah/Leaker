# Leaker

## Info 

### Korean

Leaker는 PHP 기반 웹앱에서 실행되는 랜섬웨어입니다.<br>
웹앱의 루트 디렉터리에서 실행되며, PHP 파일을 모두 aes-256 알고리즘으로 암호화합니다.<br>

Leaker는 학습 목적으로 개발되었습니다.

주의! 절대로 서비스중인 웹앱에서 실행하지 마세요!

### English

Leaker is a ransomware that can be run on PHP-based web apps. <br>
It runs in the root directory of the webapp and encrypts all PHP files using the aes-256 algorithm. <br>

Leaker was developed for learning purposes.

WARNING! Do not execute it on a web app in service!

## Info File "How_to_decrypt.txt"
![2](https://user-images.githubusercontent.com/75349747/119408812-4985ad80-bd21-11eb-99a3-f231f24c773f.PNG)

```
This website has been encrypted by Leaker v1.0!
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
How dare use the PHP shit, Leaker have never been able to forgive your website. 
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
[ https://gall.dcinside.com/programming ]<br>
If you want to recover your website, you don't need to pay.<br>
Simply follow these steps to recover your website.<br>
First, click the link above and write a post with title of "nomorephp". <br>
Second, If your post get more than 5 "개념" and posted in "개념글", Leaker will decrypt all files.<br>
Make sure not to delete anything from the directory and not to restart server (possibility of losing decryption key). 
	
Then, Good luck to you !
```

## How to decrypt without follwing "How_to_decrypt.txt"

### Korean

서버를 재부팅하지 마세요. 복호화 키가 손상될 수 있습니다. <br>
"exe.php"파일의 라인 179의 <code>if ((string)$title == "nomorephp")</code> 부분을 <code>if (True)</code>로 수정하세요. <br>
수정후 "exe.php"를 재실행하면 웹사이트가 복구됩니다.

### English

Never reboot the server. The decryption key may be lost. <br>
Modify the <code>if ((string)$title == "nomorephp")</code> part of line 179 of the "exe.php" to <code>if (True)</code>. <br>
Re-runs of "exe.php" will recover your website.

## Screenshot

### PHP files encrypted into "leaker" format

![3](https://user-images.githubusercontent.com/75349747/119408814-4a1e4400-bd21-11eb-911e-ea0bbbb32092.PNG)

### Index file replaced
![1](https://user-images.githubusercontent.com/75349747/119408809-48548080-bd21-11eb-8638-ac79cc62afe5.PNG)
<div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
