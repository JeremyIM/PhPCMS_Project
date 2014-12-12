<html>

<head>
    <?php
    session_start();
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
    <title>Assignment 2 - Welcome to Chart City</title>
    <script type="text/javascript">
        var numOfTypesData = [
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

        ////////////////////////////

    </script>
</head>



<script type="text/javascript" src="Chart.js"></script>
<body>
<table>
    <tr>
        <td>Number of Pages, Divs, Articles, Templates</td>
        <td>Number of Articles per Page (including common articles)</td>
    </tr>
    <tr>
        <td>
            <canvas id="numOfTypes" width="600" height="400"></canvas>

            <script>
                var typesPie= document.getElementById("numOfTypes").getContext("2d");
                var typesChart = new Chart(typesPie).Pie(numOfTypesData, pieOptions);
            </script>
        </td>
        <td>
            <canvas id="articlesOnPage" width="600" height="400"></canvas>

            <script type="text/javascript">
                var artsOnPageChart;
                var artOnPageData = [{
                    value: 0
                }];

                var pieOptions = {
                    segmentShowStroke : true,
                    animateScale : true
                };
                var colors = ['#2929CC', '#5C5CFF',
                    '#00527A', '#3385AD',
                    '#007A29', '#33AD5C',
                    '#A37A00', '#D6AD33',
                    '#A30000', '#D63333',
                    '#A300A3', '#D633D6',
                    '#5200CC', '#8533FF',
                    '#0029A3', '#335CD6',
                    '#00A37A', '#33D6AD',
                    '#527A00', '#85AD33'];

                var ctx= document.getElementById("articlesOnPage").getContext("2d");
                artsOnPageChart = new Chart(ctx).Pie(artOnPageData, pieOptions);
                var index = 0;
                <?php foreach($arrayOfPages as $page):?>

                artsOnPageChart.addData({
                    value: <?php echo count(ArticleClass::getPageArticlesCount($page->getId()))?>,
                    color: colors[index],
                    highlight: colors[index+1],
                    label: "<?php echo $page->getPageTitle(); ?>"
                });
                index += 2;
                <?php endforeach; ?>


            </script>
        </td>
    </tr>
    <tr>
        <td>Number of Articles per Page (excluding common articles)</td>
        <td></td>
    </tr>
    <tr>
        <td>
            <canvas id="uniqueArticlesOnPage" width="600" height="400"></canvas>

            <script type="text/javascript">
                var artsOnPageChart;

                var ctx= document.getElementById("uniqueArticlesOnPage").getContext("2d");
                artsOnPageChart = new Chart(ctx).Pie(artOnPageData, pieOptions);
                var index = 0;
                <?php foreach($arrayOfPages as $page):?>

                artsOnPageChart.addData({
                    value: <?php echo count(ArticleClass::getUniquePageArticlesCount($page->getId()))?>,
                    color: colors[index],
                    highlight: colors[index+1],
                    label: "<?php echo $page->getPageTitle(); ?>"
                });
                index += 2;
                <?php endforeach; ?>


            </script>
        </td>
        <td></td>
    </tr>

</table>

</body>
</html>