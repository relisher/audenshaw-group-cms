<?php
    function loginform() { ?>
<form method="post" action="index.php<?php echo "?id=".$_GET['id'] ?>"><input name="sid" type="password"><button type="submit">Login</submit></form>
    <?php }

    include '../config.php';
    include '../header.php';
    $sid = $_COOKIE[$db_prefix."choccookie"];
    if (sha1($sid) != $password) {
        $sid = $_POST['sid'];
        if (sha1($sid) == $password) {
            setcookie($db_prefix."choccookie", $sid, time()+(7*24*60*60));
            $_SESSION['sid'] = $sid;
        }
        else echo "Sorry, access denied!<br />";
    }
    if (sha1($sid) == $password) {
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript"><!--
            <?php if ($_GET['id']) echo "args = \"?id=" . $_GET['id'] . "\";\n";
            else echo "args = \"\";\n"; ?>
        --></script>
        <script type="text/javascript" src="ajax.js">
        </script>
        <script type="text/javascript" src="main.js">
        </script>
    </head>
    <body>
        <h1 style="margin-bottom: 10px">Admin</h1>
        <div>
            <span class="tab"><a href="javascript:tab(1)">About</a></span>
            <span class="tab"><a href="javascript:tab(2)">News</a></span>
            <span class="tab"><a href="javascript:tab(3)">Projects</a></span>
            <span class="tab"><a href="javascript:tab(4)">Members</a></span>
            <span class="tab"><a href="javascript:tab(5)">Comments</a></span>
            <span class="tab"><a href="javascript:tab(6)">Other</a></span>
        </div>
        <div class="content" id="content">
<?php adminAbout(); ?>
        </div>
    </body>
</html>
<?php } else loginform(); ?>
