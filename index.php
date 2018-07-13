<?php

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$data = array(
  "q1"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q2"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q3"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q4"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q5"=>array('yes'=>0, 'no'=>2, 'so-so'=>1),
  "q6"=>array('yes'=>0, 'no'=>2, 'so-so'=>1),
  "q7"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q8"=>array('yes'=>0, 'no'=>2, 'so-so'=>1),
  "q9"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q10"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q11"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q12"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q13"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q14"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q15"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q16"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q17"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q18"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q19"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
  "q20"=>array('yes'=>2, 'no'=>0, 'so-so'=>1),
);

$title = array(
  "q1"=>"新しいことに挑戦するのが好きだ",
  "q2"=>"様々な変化に対処するのが得意だ",
  "q3"=>"知らないことを学ぶのが好きだ",
  "q4"=>"競争的な人間関係の中で切磋琢磨するより、アットホームな雰囲気の中で働きたい",
  "q5"=>"一人で行動するより、グループで行動したい",
  "q6"=>"じっくり考えるよりもまず動きたい",
  "q7"=>"世の中に貢献したい気持ちが強い",
  "q8"=>"仕事は生活のためであり、やりがいはあまり求めない",
  "q9"=>"他人とコミュニケーションを取るのが得意である",
  "q10"=>"斬新なアイデアよりも、実現性の高いアイデアを出す方だ",
  "q11"=>"課題は自分一人よりも、他者と話し合って進めていきたい",
  "q12"=>"素早さを意識するよりも、着々と計画を進めていきたい",
  "q13"=>"リーダーシップには自信がある",
  "q14"=>"物事を企画するのが好きだ",
  "q15"=>"物事を分析するのが好きだ",
  "q16"=>"プログラミングが好きだ",
  "q17"=>"デザイン製作に興味がある",
  "q18"=>"事業運営、経営に興味がある",
  "q19"=>"HTMLやCSSの使用経験がある",
  "q20"=>"PHPの使用経験がある",
);

$total_all = 0;
$type_result = array();
$error = NULL;

if(!empty($_POST)) {   //値がPOSTされたら以下を実行

  //未回答の質問がないかを確認
  for($i = 1; $i <= 20; $i++) {
     if(!isset($_POST["q$i"])) {
         $error = '※未回答の質問があります。全ての質問に回答して下さい。';
         break;
     }
  }

  if($error == NULL) {
      //各回答の点数を合計する
      for($i = 1; $i <= 20; $i++) {
        $total_all += $data["q$i"][$_POST["q$i"]];
      }

      //質問タイプX~Zそれぞれの点数を合計する（X:プログラマー/エンジニア志向 Y：デザイナー志向 Z:マネジメント志向）
      //タイプX → q1, q15, q16, q20
      $total_X = $data['q1'][$_POST['q1']] + $data['q15'][$_POST['q15']] + $data['q16'][$_POST['q16']] + $data['q20'][$_POST['q20']];
      //タイプY → q17, q19
      $total_Y = $data['q17'][$_POST['q17']] + $data['q19'][$_POST['q19']];
      //タイプZ → q14, q18
      $total_Z = $data['q14'][$_POST['q14']] + $data['q18'][$_POST['q18']];

      //合計点によって適性度とコメントを設定
      if($total_all >= 0 && $total_all <= 10) {
        $result = 'D（可能性あり）';
        $comment = '他社と比較した上で、再度検討してみて下さい。';
      } else if($total_all >= 11 && $total_all <= 15) {
        $result = 'C（まあまあ）';
        $comment = '興味があれば、説明会や見学に参加してみて下さい。';
      } else if($total_all >= 16 && $total_all <= 30) {
        $result = 'B（適性あり）';
        $comment = 'ぜひ１度、弊社を訪れてみませんか？';
      } else {
        $result = 'A（非常に適性あり）';
        $comment = 'ぜひ私たちと一緒に働きましょう！お待ちしています！';
      }

      if($total_all > 20
          && ($data['q1'][$_POST['q1']] == 2
          || $data['q2'][$_POST['q2']] == 2
          || $data['q9'][$_POST['q9']] == 2
          || $data['q13'][$_POST['q13']] == 2
          || $data['q18'][$_POST['q18']] == 2)
        ) {
        $result = 'A（非常に適性あり）';
        $comment = 'ぜひ私たちと一緒に働きましょう！お待ちしています！';
      }
         // var_dump($total_all);

      //タイプ別の点数により適性職種を判定
      if($total_X >= 6 && $total_Y >= 3 && $total_Z >= 3) {
        $type_result['none'] = '全ての職種';
      } else {
        if($total_X >= 6) $type_result['X'] = 'プログラマー/システムエンジニア';

        if($total_Y >= 3) $type_result['Y'] = 'デザイナー';

        if($total_Z >= 3) $type_result['Z'] = 'マネジメントスタッフ';

        if($total_X < 6 && $total_Y < 3 && $total_Z < 3 ) $type_result['none'] = 'どの職種にも平等' ;
      }

      //ファイルにログを残す
      date_default_timezone_set('Asia/Tokyo');
      $filename = "./diagnosis_log.txt";
      $time = date("Y/m/d H:i");
      $ip = $_SERVER["REMOTE_ADDR"];

      $log = $time." ".$ip." ".$total_all." ".$result;  //ログ本文

      //ログの書き込み
      $fp = fopen($filename, "a");
      fputs($fp, $log."\n");
      fclose($fp);
   }
}
?>


<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="description" content="ノーザンシステムサービスの採用情報">
<meta name="keywords" content="岩手,盛岡,新卒採用,求人,ソフトウエア,開発,募集,プログラム,ＧＩＳ,可視化">
<meta name="viewport" content="width=device-width" />
<title>ノーザンシステムサービス @ 岩手県盛岡市 | 採用情報(システム開発・ソフトウェア開発・プログラマー・プログラミング・エンジニア・デザイナー・求人募集)</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/base.css" rel="stylesheet" type="text/css" />
<link href="css/diagnosis.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/base.js"></script>
<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-34759412-1']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

  (function() {
    var cx = '009970647203994562637:jhw8u0i69fu';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();

  $(function() {
      $('#result').hide().fadeIn('slow');
    });

</script>
<link href="css/google.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap">
	<header>
		<div class="content">
			<div class="clearfix">
				<h1 class="pull-left">
					<a class="a-link logo-rec" href="" title="株式会社ノーザンシステムサービス RECRUITING SITE">
						<img src="img/logo.png" alt="WEBシステム開発のノーザンシステムサービス @ 岩手県盛岡市" width="374" height="60">
					</a>
				</h1>
				<div class="pull-right google-search-wrap">
					<!-- ▼google検索 -->
					<gcse:search></gcse:search>
					<!-- ▲google検索 -->
				</div>
			</div>
			<div>
				<ul class="g-nav">
					<li><a href="">職務内容</a></li>
					<li><a href="">インタビュー</a></li>
					<li><a href="">社内の様子</a></li>
					<li><a href="">入社の流れ</a></li>
					<li><a href="">採用情報</a></li>
					<li><a href="">適性診断</a></li>
					<li><a href="">よくある質問</a></li>
					<li class="entry"><a href="">エントリー</a></li>
				</ul>
				<div class="sp-g-nav-btn">
					<a class="accordion-control">メニュー</a>
					<ul class="accordion-panel" style="display:none;">
						<li><a href="">職務内容</a></li>
						<li><a href="">インタビュー</a></li>
						<li><a href="">社内の様子</a></li>
						<li><a href="">入社の流れ</a></li>
						<li><a href="">採用情報</a></li>
						<li><a href="">インターンシップ</a></li>
						<li><a href="">よくある質問</a></li>
						<li><a href="">エントリー</a></li>
						<li><a href="">情報セキュリティ基本方針</a></li>
						<li><a href="">個人情報保護方針</a></li>
					</ul>
				</div>

			<!-- /.nav --></div>
		<!-- /.content --></div>
	</header>
	<hr/>

	<div class="content content-main">

        <!-- 診断ボタンをクリックし、未回答がない場合 -->
    	<?php if(!empty($_POST) && $error == NULL): ?>

        <div>
            <h1 class="title">ノーザンシステムサービスとの相性が分かる！<br>適性診断</h1>
            <div id="result">
              <h1>＜診断結果＞</h1>
              <p>弊社へ対するあなたの適性度は...<br><strong><?php echo h($result);?></strong></p>
              <h2><strong><?php echo h($comment);?></strong></h2>
              <p>あなたは...<br><strong>
              <?php
              foreach($type_result as $value) {
                echo $value.'<br>';
              }
              ?></strong>に向いています！
              </p>
            </div>
        </div>

    	<!-- 診断ボタンを押す前、または未回答の質問がある場合 -->
    	<?php else: ?>

        <div>
            <h1 class="title">ノーザンシステムサービスとの相性が分かる！<br>適性診断</h1>
            <div id="question">
              <p>各質問項目はあなたの日常の行動や考えにどの程度あてはまりますか？</p>
              <p>最も近いものを１つ選んでください。</p>
              <p class="error"><?php echo $error;?></p>
              <form action="" method="post">
                <table>
                  <?php for($j = 1; $j <= 20; $j++):?>
                    <tr>
                      <td class="left"><?php echo 'Q'.$j.'.';?></td>
                      <td class="center"><?php echo $title["q$j"];?></td>
                      <td class="right">
                        <label><input type="radio" name="q<?php echo $j;?>" value="yes" <?php if($_POST["q$j"] == 'yes'):?> checked <?php endif;?>> YES</label>
                        <label><input type="radio" name="q<?php echo $j;?>" value="no" <?php if($_POST["q$j"] == 'no'):?> checked <?php endif;?>> NO</label>
                        <?php if($j <= 18):?>
                          <label><input type="radio" name="q<?php echo $j;?>" value="so-so" <?php if($_POST["q$j"] == 'so-so'):?> checked <?php endif;?>> どちらでもない</label></td>
                        <?php else:?>
                          <label><input type="radio" name="q<?php echo $j;?>" value="so-so" <?php if($_POST["q$j"] == 'so-so'):?> checked <?php endif;?>> 少しだけ</label
                        <?php endif;?>
                      </td>
                    </tr>
                  <?php endfor;?>
                </table>
                <button type="submit" class="btn">診断</button>
              </form>
            </div>
        </div>

    	<?php endif; ?>

    	<div class="sp-footer-wrap">
    		<ul class="sp-footer-menu">
    			<li><a href="">職務内容</a></li>
    			<li><a href="">インタビュー</a></li>
    			<li><a href="">社内の様子</a></li>
    			<li><a href="">入社の流れ</a></li>
    			<li><a href="">採用情報</a></li>
    			<li><a href="">よくある質問</a></li>
    			<li><a href="">エントリー</a></li>
    		</ul>
    	</div>

	</div>

	<div id="page-top" class="page-top">
		<p><a id="move-page-top" class="move-page-top">▲</a></p>
	</div>

	<hr/ color="gray">
	<footer>
		<div class="content">
		<ul class="g-nav">
				<li><a style="color:black;" href="">ホーム</a></li>
				<li><a style="color:black;" href="">会社概要</a></li>
				<li><a style="color:black;" href="">業務実績</a></li>
				<li><a style="color:black;" href="">採用情報</a></li>
				<li><a style="color:black;" href="">お問い合わせ</a></li>
			</ul>
			<div class="clearfix">
				<div class="pull-left">
					<a class="a-link logo" href=""><img src="img/logo_footer.png" width="464" height="60"/></a>
				</div>
				<div class="pull-right">
					<ul class="clearfix footer-menu">
						<li>
							<a href="">情報セキュリティ基本方針</a>
						</li>
						<li>
							<a href="">個人情報保護方針</a>
						</li>
					</ul>
				</div>
			</div>
			<p class="copyright">
				Copyright &copy; Northern system service Co.,Ltd. All Rights Reserved.
			</p>
		<!-- /.content --></div>
	</footer>
<!-- /.wrap --></div>
</body>
</html>
