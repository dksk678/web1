
<!DOCTYPE html>

<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background: #fcfceb;
	overflow:auto;
        }
         .content{
	text-align:center;
            background: #fcfceb;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }


        .title1 {
            float: left;
            margin-top: 30px;
        }

        #body-c {
            text-align:center;
        }

        .bbtn {
            line-height: 200px;
        }

        canvas {
            border: 5px solid blue;
            background: black;
            margin-right: 60px;
        }

        .btn {
            transition: font-size 0.1s;
            background-color: black;
            color: white;
            cursor: pointer;
            border: 2px solid magenta;
            width: 200px;
            font-size: 25px;
            height: 50px;
            font-variant: small-caps;
            text-align: center;
            position: relative;
            line-height: 30px;
        }

        .btn1 {
            transition: font-size 0.1s;
            background-color: black;
            color: white;
            cursor: pointer;
            border: 2px solid magenta;
            width: 200px;
            font-size: 25px;
            height: 50px;
            font-variant: small-caps;
            text-align: center;
            position: relative;
            line-height: 50px;
        }


        .btn:hover {
            font-size: 120%;
        }

        .btn1:hover {
            font-size: 120%;
        }

        #sub-section {
            float: middle;
        }


        .aside-list > h1 {
            margin-left: 40px;
            font-weight: 600;
        }

        .aside-list li a {
            margin-left: 8px;
            font-size: 13px;
            color: #6C6C6C;
        }

        .myscore {
            text-align: center;
            font-size: 20px;
            position: relative;
        }
    </style>
    <style>
        h1 {
            height: 100px;
            width: 100%;
            font-size: 18px;
            background: black;
            color: white;
            line-height: 150%;
            border-radius: 3px 3px 0 0;
            box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.2);
        }

        form {
            box-sizing: border-box;
            width: 260px;
            margin: 5px;
            box-shadow: 2px 2px 5px 1px rgba(0, 0, 0, 0.2);
            padding-bottom: 40px;
            border-radius: 3px;
        }

            form h1 {
                box-sizing: border-box;
                padding: 20px;
            }

        input {
            margin: 40px 25px;
            width: 200px;
            display: block;
            border: none;
            padding: 10px 0;
            border-bottom: solid 1px black;
            background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 96%, black 4%);
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, black 4%);
            background-position: -200px 0;
            background-size: 200px 100%;
            background-repeat: no-repeat;
            color: #0e6252;
        }


        button {
            border: none;
            background: black;
            cursor: pointer;
            border-radius: 3px;
            padding: 6px;
            width: 200px;
            color: white;
            margin-left: 25px;
            box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.2);
        }

            button:hover {
                -webkit-transform: translateY(-3px);
                -ms-transform: translateY(-3px);
                transform: translateY(-3px);
                box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.2);
            }
    </style>

</head>

<body>
    <div id="body-c">
        <center style="line-height:100px;">
            <input type="button" id="bbtn" class="btn" value="시작!" />
            <div class="btn1">
                <a href="http://222.116.81.48/html222/학술제.html" style="text-align:center;"><font color="white">첫 화면으로</font></a>
            </div>
            <div>
                <b class="myscore">SCORE: <span id="score">&nbsp</span></b>
            </div>
        </center>
    </div>
    
    <div class="content">
        <canvas width="400" height="400" id="game"></canvas>

        <form method="post" action="http://172.30.1.21/snake.php">
            <h1>닉네임을 입력해주세요.</h1>
            <input placeholder="Username" type="text" name="userName" required="" />
            <input placeholder="My Score!" type="text" name="score1" id="score1" readonly />
            <input type="submit" value="확인">
        </form>


        <section id="main-section">

            <script>

                document.getElementById('bbtn').onclick = function () {

                    start();
                }

                function start() {
                    document.getElementById('bbtn').onclick = function () {
                        document.location.reload();
                        start();
                    }

                    var canvas = document.getElementById('game');
                    var context = canvas.getContext('2d');
                    var grid = 16;
                    var count = 0;

                    var snake = {
                        x: 160,
                        y: 160,

                        //grid 크기 조절하는거 넣기
                        dx: grid,
                        dy: 0,

                        //세포 크기
                        cells: [],

                        //초기 크기
                        maxCells: 4
                    };

                    var score = 0;
                    var highScore = 4;

                    var apple = {
                        x: 320,
                        y: 320
                    };

                    //범위 안에 임의 숫자넣기https://stackoverflow.com/a/1527820/2124254
                    function getRandomInt(min, max) {
                        return Math.floor(Math.random() * (max - min)) + min;
                    }
                    // 게임 루프
                    function loop() {
                        requestAnimationFrame(loop);
                        // 게임 속도 조절하기!
                        if (++count < 4) {
                            return;
                        }
                        count = 0;
                        context.clearRect(0, 0, canvas.width, canvas.height);
                        // 속도 입력
                        snake.x += snake.dx;
                        snake.y += snake.dy;
                        // 가로 수정
                        if (snake.x < 0) {
                            snake.x = canvas.width - grid;
                        }
                        else if (snake.x >= canvas.width) {
                            snake.x = 0;
                        }

                        //세로 수정
                        if (snake.y < 0) {
                            snake.y = canvas.height - grid;
                        }
                        else if (snake.y >= canvas.height) {
                            snake.y = 0;
                        }
                        // 뱀 크기 앞배열에 추가
                        snake.cells.unshift({ x: snake.x, y: snake.y });
                        // 최대크기보다 길면 마지막 배열 삭제
                        if (snake.cells.length > snake.maxCells) {
                            snake.cells.pop();
                        }
                        // 사과 나타내는거
                        context.fillStyle = 'red';
                        context.fillRect(apple.x, apple.y, grid - 1, grid - 1);
                        // 한개씩 추가되기
                        context.fillStyle = 'green';
                        snake.cells.forEach(function (cell, index) {
                            // 뱀의 마디를 나눠서 보여줄려고 -1 함.
                            context.fillRect(cell.x, cell.y, grid - 1, grid - 1);
                            // 뱀이 사과를 먹으면
                            if (cell.x === apple.x && cell.y === apple.y) {
                                snake.maxCells++;
                                score++;
                                if (highScore < score) {
                                    highScore = score;
                                }
                                // 캔버스 안에 랜덤함수 이용해서 사과 나타내기
                                apple.x = getRandomInt(0, 25) * grid;
                                apple.y = getRandomInt(0, 25) * grid;
			
		        document.getElementById('score1').value = score;
                                document.getElementById('score').innerHTML = score;
                            }
                            // 머리와 각각의 마디만큼 반복
                            for (var i = index + 1; i < snake.cells.length; i++) {

                                //머리가 다른 마디와 부딪히면 리셋
                                if (cell.x == snake.cells[i].x && cell.y == snake.cells[i].y) {

                                    return start();
                                    
                                }
                            }
                        });
                    }
                    // 키입력 받기.
                    document.addEventListener('keydown', function (e) {

                        //왼쪽
                        if (e.which === 37 && snake.dx === 0) {
                            snake.dx = -grid;
                            snake.dy = 0;
                        }
                        //상
                        else if (e.which === 38 && snake.dy === 0) {
                            snake.dy = -grid;
                            snake.dx = 0;
                        }
                        //오른쪽
                        else if (e.which === 39 && snake.dx === 0) {
                            snake.dx = grid;
                            snake.dy = 0;
                        }//하
                        else if (e.which === 40 && snake.dy === 0) {
                            snake.dy = grid;
                            snake.dx = 0;
                        }
                    });

                    // start the game
                    requestAnimationFrame(loop);

                }
            </script>

        </section>


        <section id="sub-section">

            <div class="aside-list">

                <?php
                $connect = mysqli_connect("localhost","root","1111","snake") or die(mysql_error());
                $sql = "SELECT * FROM userTbl";
                $ret = mysqli_query($connect, $sql);
                $num = 1;
                if($ret)
                {$count =mysqli_num_rows($ret);
                }
                else{echo"실패";
                exit();
                }
                echo "<h2>랭킹</h2>";
                echo "<TABLE border=1>
                    ";
                    echo "
                    <TR>
                        ";
                        echo "
                        <TH>score!</TH>";
                        echo "
                    </TR>";
                    while (($row = mysqli_fetch_array($ret)) && $num < 5){
                    echo "
		
                    <TR>
                        ";
                        echo "
                        <td>", $num, "등","&nbsp", $row['name'], "&nbsp", $row['score'], "점", "</td>";
                        echo "
                    </TR>";
                    $num = $num + 1;
                    }

                    mysql_close($connect);
                    echo"
                </TABLE>";
                ?>

            </div>
        </section>

    </div>

</body>
</html>
