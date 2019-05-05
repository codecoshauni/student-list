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
                    <form name="search" method="get" action="/" autocomplete="off">
                        <input type="hidden" name="by" value="<?= htmlspecialchars($linksService->getOrderBy()) ?>">
                        <input type="hidden" name="in" value="<?= htmlspecialchars($linksService->getOrderDirection()) ?>">
                        <input class='field' type="search" name="search" placeholder="List search"
                               value="<?= htmlspecialchars($linksService->getSearch()) ?>">
                        <input class='button' type="submit" value="Find">
                    </form>
                </div>
                <a href="/profile">My profile</a>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="search-info">
                <?php if ($linksService->getSearch()):?>
                    <p>Only students found for "<?= htmlspecialchars($linksService->getSearch()) ?>" are shown:</p>
                    <a href="/">Show all</a>
                <?php endif; ?>
            </div>
            <table>
                <tr>
                    <th><a <?php if ($linksService->getOrderBy() == 'name') echo "class=\"{$linksService->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($linksService->getSortingLink('name')) ?>">Name</a></th>
                    <th><a <?php if ($linksService->getOrderBy() == 'surname') echo "class=\"{$linksService->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($linksService->getSortingLink('surname')) ?>">Surname</a></th>
                    <th><a <?php if ($linksService->getOrderBy() == 'group_number') echo "class=\"{$linksService->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($linksService->getSortingLink('group_number')) ?>">Group</a></th>
                    <th><a <?php if ($linksService->getOrderBy() == 'points') echo "class=\"{$linksService->getOrderDirection()}\"" ?>
                                href="<?= htmlspecialchars($linksService->getSortingLink('points')) ?>">Points</a></th>
                </tr>
                <?php if ($studentData): ?>
                    <?php foreach ($studentData as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['surname']) ?></td>
                        <td><?= htmlspecialchars($student['group_number']) ?></td>
                        <td><?= htmlspecialchars($student['points']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </table>
            <div class="pagination">
                    <?php if ($linksService->getPagesCount()):?>
                        <p>Pages:</p>
                        <?php for ($i = 1; $i <= $linksService->getPagesCount(); ++$i):?>
                            <a href="<?= htmlspecialchars($linksService->getPageLink($i)) ?>"><?= $i ?></a>
                        <?php endfor; ?>
                    <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>
