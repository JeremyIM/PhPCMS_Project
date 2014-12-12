<html>

<head>
    <title>Assignment 2 - Welcome to Chart City</title>
</head>

<?php
require("../Business/ArticleClass.php");
require("../Business/PageClass.php");
require("../Business/ContentAreaClass.php");
require("../Business/CssClass.php");

$arrayOfArticles = ArticleClass::retrieveArticles();
$arrayOfPages = PageClass::retrievePages();
$arrayOfDivs = ContentAreaClass::retrieveDivs();
$arrayOfTemplates = CssClass::retrieveTemplates();

$pageCount = count($arrayOfPages);
$artCount = count($arrayOfArticles);
$divCount = count($arrayOfDivs);
$cssCount = count($arrayOfTemplates);

?>

<script type="text/javascript" src="Chart.js"></script>


<canvas id="countries" width="600" height="400"></canvas>

<script>

    var pieData = [
        {
            value: <?php echo $pageCount; ?>,
            color:"#878BB6",
            label: "Pages"
        },
        {
            value : <?php echo $artCount; ?>,
            color : "#4ACAB4",
            label: "Articles"
        },
        {
            value : <?php echo $divCount; ?>,
            color : "#FF8153",
            label: "Content Areas"
        },
        {
            value : <?php echo $cssCount; ?>,
            color : "#FFEA88",
            label: "Templates"
        }
    ];

    var pieOptions = {
        segmentShowStroke : false,
        animateScale : true
    };

    var countries= document.getElementById("countries").getContext("2d");
    new Chart(countries).Pie(pieData, pieOptions);



</script>

</html>