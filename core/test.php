<?php
/*
$config = parse_ini_file ($_SERVER['DOCUMENT_ROOT']."/config.ini", TRUE)["main_db"];

$dsn = "mysql:host=$config[host];dbname=testDB;charset=utf8";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $config["user"], $config["password"], $opt);


$stmt = $pdo->prepare('INSERT INTO testTable(varch,dt) VALUES (?,?)');
$stmt->execute(["test1","2012-12-12 12:12"]);
*/
?>
<html>
<head>
    <title>TEST</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

<script>
    $.ajax({
            url: '/core/admin/getOlympiadData.php',
            type: 'POST',
            data: 'olympId=1',
            success: function (res) {
                document.body.innerHTML = "<pre>" + res + "</pre>";
            }
        }
    );
</script>
<!--<script>
    var a = {
    "name": "json test 4",
        "grade": "2",
        "refresh_time": "3",
        "refresh_SQL_request": "2",
        "start_time": "2012-12-12 12:12",
        "finish_time": "2000-03-02 02:02",
        "tasks": [
            {
                "task_id": "1",
                "isOpenAnswer": 0,
                "TEX_code": "123",
                "task_variables": ["a", "b", "c"],
                "variants": ["{\"variantNumber\":\"1\",\"a\":\"1\",\"b\":\"2\",\"c\":\"3\",\"answer\":\"4\"}", "{\"variantNumber\":\"2\",\"a\":\"5\",\"b\":\"6\",\"c\":\"7\",\"answer\":\"8\"}"]
            }, {
                "task_id": "2",
                "isOpenAnswer": 1,
                "TEX_code": "3",
                "task_variables": ["d", "e", "f", "g"],
                "variants": ["{\"variantNumber\":\"1\",\"d\":\"9\",\"e\":\"10\",\"f\":\"11\",\"g\":\"12\"}", "{\"variantNumber\":\"2\",\"d\":\"14\",\"e\":\"15\",\"f\":\"16\",\"g\":\"17\"}", "{\"variantNumber\":\"3\",\"d\":\"19\",\"e\":\"20\",\"f\":\"21\",\"g\":\"22\"}", "{\"variantNumber\":\"4\",\"d\":\"24\",\"e\":\"25\",\"f\":\"26\",\"g\":\"27\"}"]
            }, {
                "task_id": "3",
                "isOpenAnswer": 0,
                "TEX_code": "3",
                "task_variables": ["s", "J", "k"],
                "variants": ["{\"variantNumber\":\"1\",\"s\":\"l\",\"J\":\"m\",\"k\":\"3\",\"answer\":\"2\"}", "{\"variantNumber\":\"2\",\"s\":\"1\",\"J\":\"3\",\"k\":\"4\",\"answer\":\"5\"}", "{\"variantNumber\":\"3\",\"s\":\"7\",\"J\":\"8\",\"k\":\"91\",\"answer\":\"\"}"]
            }
        ]
    };

    $.ajax({
        url: '/core/admin/addOlympiad.php',
        type: 'POST',
        data: 'olympData=' + JSON.stringify(a),
        success: function (res) {
        document.body.innerHTML = "<pre>" + res + "</pre>";
    }
    });

</script>-->
</body>
</html>