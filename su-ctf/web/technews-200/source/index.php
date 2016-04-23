<?php
    if (extract_teamname_from_cookie("technews") === false)
	die("\n\n\n");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Technology News</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
  <div id="header">
    <div id="topbar">
      <h1 id="sitename"><a href="index.php">Technology<span>News</span></a><span></span></h1>
      <form action="search.php" method="get">
        <div id="topsearch">
          <input type="text" name="query" size="25" />
        </div>
      </form>
    </div>
    <div id="headercontent">
      <h2 id="description">Technology News</h2>
      <div id="headerlinks"><img src="files/images/rss.jpg" alt="" width="128" height="70" /></div>
    </div>
    <div id="topnav">
      <ul>
        <li class="active"><a href="index.php">Home</a></li>
      </ul>
    </div>
  </div>
  <div id="page">
    <div id="contents">
      <div class="post">
        <h2>News Headings</h2>
        <p> It's 2016 and there's a feeling of hope and renewal in the air. That can mean only one thing: It's time for some New Year's resolutions. What did you vow to change this year? Are you going to learn a new skill? Pay off your credit card debt? Lose 40 pounds? Whatever your plans are, don't forget to throw in a few resolutions that involve the technology in your life. The best part of tech resolutions is they're fairly easy to keep and can improve your life almost right away. We've got seven suggestions below on how to make technology central to your plans for an awesome 2016. <span class="readmore"><a target="_blank" href="http://www.pcworld.com/article/3017780/software/7-technology-resolutions-for-a-better-2016.html">Read More</a></span></p>
      </div>
      <div id="col1">
        <h2 class="subhead">Latest</h2>
        <div class="post_item"> <img src="files/images/robot.jpg" alt="" />
          <h3>The first affordable robot servant, Alpha2, is now in development</h3>
          <p>The fantasy of having your own benign, high-tech, vaguely humanoid robot servant goes back at least to Robby the Robot, the star of the 1956 science-fiction classic Forbidden Planet. Robby could cook, clean, carry several tons of cargo, and whip up anything from diamonds to booze from inside his body. He also followed Asimov’s laws of robotics.  <span class="readmore"><a target="_blank" href="http://www.techhive.com/article/3004617/robots/the-first-affordable-robot-servant-alpha2-is-now-in-development.html">Read More</a></span> </p>
        </div>
        <div class="post_item"> <img src="images.php?id=files/images/heart.jpg" alt="" />
          <h3>Heartbleed-like bug in OpenSSH dismissed as a hoax</h3>
          <p>Hackers claiming to have found a critical flaw in a widely used open-source remote login software, OpenSSH, are likely bluffing, according to a developer affiliated with the project.<span class="readmore"><a target="_blank" href="http://www.pcworld.com/article/2151560/heartbleedlike-bug-in-openssh-dismissed-as-a-hoax.html">Read More</a></span></p>
        </div>
      </div>
      <div id="col2">
        <h2 class="subhead">Popular </h2>
        <div class="post_item">
          <h3>U.S. will require registration process for drones</h3>
          <p>Hobbyists and companies alike are trying out drones for fun and commercial purposes, and as the sky starts to get crowded there is a growing cry to regulate the remote-controlled aircraft. The U.S. Dept. of Transportation on Monday said it would form a task force that will come up with a registration process for drones by Nov. 20. <span class="readmore"><a target="_blank" href="http://www.pcworld.com/article/2994821/government/us-to-require-registration-process-for-drones.html">Read More</a></span></p>
        </div>
        <div class="post_item">
          <h3>Senate bill aims to make it a federal offense to fly drones recklessly</h3>
          <p> <img src="files/images/robot2.jpg" alt="" width="100" height="87" />A bill was introduced in the U.S. Senate on Wednesday that will make it a misdemeanor, punishable by a fine or imprisonment for up to a year, for individuals who knowingly operate a drone within 2 miles of a fire, an airport or any other restricted airspace. <span class="readmore"><a target="_blank" href="http://www.pcworld.com/article/2990470/gadgets/senate-bill-aims-to-make-it-a-federal-offense-to-fly-drones-recklessly.html">Read More</a></span> </p>
        </div>
      </div>
    </div>
    <div id="sidebar">
      <ul>
        <li>
          <h2>About</h2>
          <p>You can see the latest technology news at this website.</p>
        </li>
      </ul>
    </div>
    <div class="clear">&nbsp;</div>
  </div>
  <div id="footer">
      <div id="leftfoot"><br />
      <a href="http://ramblingsoul.com">CSS Template</a> by RamblingSoul</span><br />
    </div>
    <div id="rightfoot"> <a href="#wrap">Back To Top</a></div>
  </div>
</div>
</body>
</html>