<?php


function display_header($show = 0)
{
    $_POST['show'] = $show ? 1 : 0;
    include 'header.php';
}
function display_footer()
{
    include 'footer.php';
}
function display_link()
{
    include 'links.php';
}
function display_script()
{
    include 'script.php';
}
