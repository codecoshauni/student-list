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
        <h1><?= htmlspecialchars($headerCaption) ?></h1>
        <a class="showlist" href="/">Show list</a>
    </div>
</header>
<section>
    <div class="container">
        <div class="action-info">
            <p><?= htmlspecialchars($notice) ?></p>
        </div>
        <form name="profile" method="post" action="/profile" autocomplete="off">
            <input type="hidden" name="xsrfToken" value="<?= htmlspecialchars($xsrfToken) ?>">
            <p>Name</p>
            <input class='field write' type="text" name="name" maxlength="20" placeholder="less than 21 letters"
                   pattern="[A-Za-zА-Яа-яЁё]+$" autofocus required
                   value="<?php if (!empty($student)) echo htmlspecialchars($student->getName()) ?>">
            <p class='error'><?php if (isset($errors['name'])) echo htmlspecialchars($errors['name']) ?></p>
            <p>Surname</p>
            <input class='field write' type="text" name="surname" placeholder="less than 31 letters"
                   pattern="[A-Za-zА-Яа-яЁё]+$" maxlength="30" required
                   value="<?php if (!empty($student)) echo htmlspecialchars($student->getSurname()) ?>">
            <p class='error'><?php if (isset($errors['surname'])) echo htmlspecialchars($errors['surname']) ?></p>
            <p>E-mail</p>
            <input class='field write' type="email" name="email" placeholder="less than 41 characters"
                    maxlength="40" required
                    value="<?php if (!empty($student)) echo htmlspecialchars($student->getEmail()) ?>">
            <p class='error'><?php if (isset($errors['email'])) echo htmlspecialchars($errors['email']) ?></p>
            <p>Year of birth</p>
            <input class='field write' type="text" name="birth_year" maxlength="4" placeholder="only 4 digits"
                   pattern="[0-9]{4}" required
                   value="<?php if (!empty($student)) echo htmlspecialchars($student->getBirthYear()) ?>">
            <p class='error'><?php if (isset($errors['birth_year'])) echo htmlspecialchars($errors['birth_year']) ?></p>
            <p>Group number</p>
            <input class='field write' type="text" name="group_number" placeholder="2 - 5 characters"
                    pattern="[A-Za-zА-Яа-яЁё-0-9]{2,}" maxlength="5" required
                    value="<?php if (!empty($student)) echo htmlspecialchars($student->getGroupNumber()) ?>">
            <p class='error'><?php if (isset($errors['group_number'])) echo htmlspecialchars($errors['group_number']) ?></p>
            <p>Points</p>
            <input class='field write' type="number" name="points" placeholder="between 7 and 400"  pattern="[0-9]{1,}"
                   maxlength="3" required
                   value="<?php if (!empty($student)) echo htmlspecialchars($student->getpoints()) ?>">
            <p class='error'><?php if (isset($errors['points'])) echo htmlspecialchars($errors['points']) ?></p>
            <p>Sex:</p>
            <input id='ml' class='field choose' type="radio" name="sex" value='male' required
                    <?php if (!empty($student) && $student->getSex() == Students\Model\Student::SEX_MALE):?>
                        checked
                    <?php endif; ?>
                    ><label for='ml'>Male</label>
            <input id='fml' class='field choose' type="radio" name="sex" value='female'
                    <?php if (!empty($student) && $student->getSex() == Students\Model\Student::SEX_FEMALE):?>
                        checked
                    <?php endif; ?>
                    ><label for='fml'>Female</label>
            <p class='error'><?php if (isset($errors['sex'])) echo htmlspecialchars($errors['sex']) ?></p>
            <p>Habitation:</p>
            <input id='lcl' class='field choose' type="radio" name="habitation" value='local' required
                    <?php if (!empty($student) && $student->getHabitation() == Students\Model\Student::HABITATION_LOCAL):?>
                        checked
                    <?php endif; ?>
                    ><label for='lcl'>Local</label>
            <input id='nonr' class='field choose' type="radio" name="habitation" value='nonresident'
                    <?php if (!empty($student) && $student->getHabitation() == Students\Model\Student::HABITATION_NONRESIDENT):?>
                        checked
                    <?php endif; ?>
                    ><label for='nonr'>Nonresident</label>
            <p class='error'><?php if (isset($errors['habitation'])) echo htmlspecialchars($errors['habitation']) ?></p>
            <input class='button' type="submit" value="Send">
        </form>
    </div>
</section>
</body>
</html>