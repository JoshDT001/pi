<!DOCTYPE html>
<?php
    
    require_once 'classes/Membership.php';
    require_once 'classes/MediaFile.php';
    
    $membership = New Membership();
    $membership->confirm_Member();
    
    function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }
    
    
    if(isset($_GET['media'])) {
        $dir = $_GET['media'];
        $fullpath = 'files/media/' . $dir;
    } else {
        header("location: media.php");
    }
    
    $_SESSION['media'] = $fullpath;
    $mediafile = new MediaFile();
    $mediafile->validateFile();
    
?>

<html data-cast-api-enabled="true">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/normalize.css">
        <!-- <script src="video.js"></script> -->

        <link rel="stylesheet" href="dist/videojs.chromeCast.css" type="text/css"/>
        <link href="libs/video-js-4.2.1/video-js.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js"></script>
        <script src="libs/video-js-4.2.1/combined.video.js"></script>
        <script src="dist/videojs.chromeCast.js"></script>


        <style>
            body {
                background-color: #eeeeee;
                font-family: Verdana, Arial, sans-serif;
                font-size: 90%;
                margin: 4em 0;
            }

            header {
                float: left;
                margin: 0 0 5px 0;
                padding: 0 0 0 0;
                width: 100%;
            }

            article, footer {
                display: block;
                margin: 0 auto;
                width: 90%;
            }

            a {
                color: #004466;
                text-decoration: none;
            }
                a:hover {
                text-decoration: underline;
            }

            a:visited {
                color: #666666;
            }

            article {
                background-color: #ffffff;
                border: #cccccc solid 1px;
                -moz-border-radius: 11px;
                -webkit-border-radius: 11px;
                border-radius: 11px;
                padding: 0 1em;
            }

            h1 {
                font-size: 140%;
            }

            ol {
                line-height: 1.4em;
                list-style-type: disc;
            }

            li.directory a:before {
                content: '[ ';
            }

            li.directory a:after {
                content: ' ]';
            }

            footer {
                font-size: 70%;
                text-align: center;
            }

            nav {
                text-align: center;
                padding: 5px 0;
                margin: 10px 0 0;
            }

            nav ul {
                list-style: none;
                margin: 0 10px;
                padding: 0;
            }

            nav li {
                display: inline-block;
            }

            nav a {
                font-weight: 800;
                padding: 15px 10px;
            }

            nav a, nav a:visited {
                color: #000;
            }

            nav a.selected, nav a:hover {
                color: #0F88B3;
            }
        </style>
        <title>Media Player</title>
    </head>
    <body oncontextmenu="return false">
        <nav>
            <ul>
                <li><a href="browser.php?files=movies">Movies</a></li>
                <li><a href="browser.php?files=tvshows">TV Shows</a></li>
                <li><a href="account.php">My Account</a></li>
            </ul>
        </nav>
        <article>
            <h1>Media Player</h1>
            <?php
                $list = explode('/', $dir);
                $item = '';
                foreach ($list as $value) {
                    $item = $item . '/' . $value;
                    printf(' / <a href="browser.php?files=%s">%s</a>', substr($item, 1), $value);
                    $filename = 'files/media/movies/subs/' . $value;
                }
                $filename = substr_replace($filename,"srt",-3);
            ?>
            <p>
                <video id="video" controls preload="none" class="video-js vjs-default-skin" autoplay width="858" height="480" poster="http://www.videojs.com/img/poster.jpg">
                    <source src="<?php echo $fullpath  ?>" type='video/mp4' />
                    <?php
                        if(file_exists($filename)) {
                            printf('<track kind="subtitles" src="%s" srclang="pt" label="English" default>', $filename);
                        }
                        ?>
                </video>
                <script>
                    videojs('video', {'plugins': {'chromecast': {}}, 'techOrder' : ['Html5', 'ChromecastTech']});
                </script>
            </p>

        </article>

        <footer>
            <p><a href="login.php?status=loggedout">Logout</a></p>
        </footer>
    </body>
</html>
