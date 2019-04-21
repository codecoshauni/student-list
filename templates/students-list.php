<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style-students-list.css">
    <link rel="stylesheet" href="/css/fontstyle.css">
    <title>Students list</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Students list</h1>
            </div>
            <div class="search">
                    <form name="search" method="get" action="#" autocomplete="off">
                        <input class='field' type="search" name="search" placeholder="List search">
                        <input class='button' type="submit" value="Find">
                    </form>
                </div>
                <a href="/profile">My profile</a>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="search-info">
                    <p>Only students found for 'Birdney Tom' are shown:</p>
                    <a href="#">Show all</a>
            </div>
            <table>
                <tr>
                    <th><a class='asc' href="#">Name</a></th>
                    <th><a class='desc' href="#">Surname</a></th>
                    <th><a href="#">Group</a></th>
                    <th><a href="#">Points</a></th>
                </tr>
                <tr>
                    <td>Futterkiste</td>
                    <td>Anders</td>
                    <td>32423</td>
                    <td>23</td>
                </tr>
                <tr>
                    <td>Moctezuma</td>
                    <td>Chang</td>
                    <td>23232</td>
                    <td>42</td>
                </tr>
                <tr>
                    <td>Ernst</td>
                    <td>Mendel</td>
                    <td>232342</td>
                    <td>377</td>
                </tr>
                <tr>
                    <td>Island Trading</td>
                    <td>Helen Bennett</td>
                    <td>23242</td>
                    <td>233</td>
                </tr>
                <tr>
                    <td>Winecellars</td>
                    <td>Yoshi Tannamuri</td>
                    <td>23232</td>
                    <td>112</td>
                </tr>
                <tr>
                    <td>Magazzini</td>
                    <td>Giovanni Rovelli</td>
                    <td>234223</td>
                    <td>234</td>
                </tr>
                <tr>
                    <td>Ernst</td>
                    <td>Mendel</td>
                    <td>232342</td>
                    <td>377</td>
                </tr>
                <tr>
                    <td>Island Trading</td>
                    <td>Helen Bennett</td>
                    <td>23242</td>
                    <td>233</td>
                </tr>
                <tr>
                    <td>Winecellars</td>
                    <td>Yoshi Tannamuri</td>
                    <td>23232</td>
                    <td>112</td>
                </tr>
                <tr>
                    <td>Magazzini</td>
                    <td>Giovanni Rovelli</td>
                    <td>234223</td>
                    <td>234</td>
                </tr>
            </table>
            <div class="pagination">
                    <p>Pages:</p>
                    <a href="#">1</a>
                    <a class='selected' href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
            </div>
        </div>
    </section>
</body>
</html>
