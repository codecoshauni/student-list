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
            <a href="/">
            <div class="logo">
                <h1>Students list</h1>
            </div>
            </a>
            <div class="search">
                    <form name="search" method="get" action="/" autocomplete="off">
                        <?php if (htmlspecialchars($listOutputHelper->getOrderBy())): ?>
                            <input type="hidden" name="by" value="<?= htmlspecialchars($listOutputHelper->getOrderBy()) ?>">
                            <input type="hidden" name="in" value="<?= htmlspecialchars($listOutputHelper->getOrderDirection()) ?>">
                        <?php endif; ?>
                        <input class='field' type="search" name="search" placeholder="List search" required
                               value="<?= htmlspecialchars($listOutputHelper->getSearch()) ?>">
                        <input class='button' type="submit" value="Find">
                    </form>
                </div>
                <a class="myprofile" href="/profile">My profile</a>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="search-info">
                <?php if ($listOutputHelper->getSearch()):?>
                    <p>"<?= htmlspecialchars($listOutputHelper->getSearch()) ?>" are shown:</p>
                    <a href="/">Show all</a>
                <?php endif; ?>
            </div>
            <table>
                <tr>
                    <th><a <?php if ($listOutputHelper->getOrderBy() == 'name') echo "class=\"{$listOutputHelper->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($listOutputHelper->getSortingLink('name')) ?>">Name</a></th>
                    <th><a <?php if ($listOutputHelper->getOrderBy() == 'surname') echo "class=\"{$listOutputHelper->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($listOutputHelper->getSortingLink('surname')) ?>">Surname</a></th>
                    <th><a <?php if ($listOutputHelper->getOrderBy() == 'group_number') echo "class=\"{$listOutputHelper->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($listOutputHelper->getSortingLink('group_number')) ?>">Group</a></th>
                    <th><a <?php if ($listOutputHelper->getOrderBy() == 'points') echo "class=\"{$listOutputHelper->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($listOutputHelper->getSortingLink('points')) ?>">Points</a></th>
                </tr>
                <?php if ($studentData): ?>
                    <?php foreach ($studentData as $student): ?>
                    <tr>
                        <td><?= $listOutputHelper->markSearchValue($student['name'])  ?></td>
                        <td><?= $listOutputHelper->markSearchValue($student['surname']) ?></td>
                        <td><?= $listOutputHelper->markSearchValue($student['group_number']) ?></td>
                        <td><?= $listOutputHelper->markSearchValue($student['points']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </table>
            <div class="pagination">
                    <?php if ($listOutputHelper->getPagesCount() > 1):?>
                        <p>Pages:</p>
                        <?php for ($i = 1; $i <= $listOutputHelper->getPagesCount(); ++$i):?>
                            <a <?php if ($listOutputHelper->getPage() == $i) echo 'class="selected"' ?>
                                    href="<?= htmlspecialchars($listOutputHelper->getPageLink($i)) ?>"><?= $i ?></a>
                        <?php endfor; ?>
                    <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>
