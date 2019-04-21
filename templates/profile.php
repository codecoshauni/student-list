<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style-profile.css">
    <link rel="stylesheet" href="/css/fontstyle.css">
    <title>My profile</title>
</head>
<body>
<header>
    <div class="container">
        <h1>Fill out the form below to add your profile to the list</h1>
        <a href="/">Show list</a>
    </div>
</header>
<section>
    <div class="container">
        <div class="action-info">
            <p>Congratulations! Your profile has been successfully added to the list!</p>
        </div>
        <form name="profile" method="post" action="/profile" autocomplete="off">
            <p>Name</p>
            <input class='field write' type="text" name="name" maxlength="20" placeholder="less than 21 letters" pattern="[A-Za-zА-Яа-яЁё]+$" autofocus required>
            <p>Surname</p>
            <input class='field write' type="text" name="surname" placeholder="less than 31 letters" pattern="[A-Za-zА-Яа-яЁё]+$" maxlength="30" required>
            <p>E-mail</p>
            <input class='field write' type="email" name="email" placeholder="less than 41 characters" maxlength="40" required>
            <p class='error'>E-mail too short!</p>
            <p>Year of birth</p>
            <input class='field write' type="text" name="year" maxlength="4" placeholder="only 4 digits" pattern="[0-9]{4}" required>
            <p>Group number</p>
            <input class='field write' type="text" name="group" placeholder="2 - 5 characters" pattern="[A-Za-zА-Яа-яЁё-0-9]{2,}" maxlength="5" required>
            <p class='error'>E-mail too short!</p>
            <p>Points</p>
            <input class='field write' type="number" name="points" placeholder="between 7 and 400"  pattern="[0-9]{1,}" maxlength="3" required>
            <p>Sex:</p>
            <input id='ml' class='field choose' type="radio" name="sex" value='male' required><label for='ml'>Male</label>
            <input id='fml' class='field choose' type="radio" name="sex" value='female'><label for='fml'>Female</label>
            <p>Habitation:</p>
            <input id='lcl' class='field choose' type="radio" name="habitation" value='local' required><label for='lcl'>Local</label>
            <input id='nonr' class='field choose' type="radio" name="habitation" value='nonresident'><label for='nonr'>Nonresident</label>
            <input class='button' type="submit" value="Send">
        </form>
    </div>
</section>
</body>
</html>
