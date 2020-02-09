<?php


/*
     * ------------------------------------------------------------------------------------------------------------
     * Конечно лучше все записать через ORM, но как понимаю нужен натив
     *  б, в чисто запросом не придумал как сделать. Но было бы классно если дали фитбек как сделать одним запросом =)
     * -------------------------------------------------------------------------------------------------------------
     *
     *   Выполнить запросы к данной БД. Исходные данные: изначально у всех людей из таблицы persons было по 100 рублей. 
     *   Передача денег из таблицы transactions отражает кто (from) кому(to) сколько денег передал.
     *   а) написать запрос, который бы выводил полное имя и баланс человека на данный момент
     *   б) написать запрос, который бы выводил город, представители которого участвовали в передаче денег наибольшее количество раз
     *   в) написать запрос, отражающий все транзакции, где передача денег осуществлялась между представителями одного города
     *
     * */


$user = 'admin';
$pass = 'пароль';

$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
$stmt = $dbh->query('SELECT persons.fullName, SUM(transactions.amount) from persons 
                               JOIN  transactions ON transactions.to_person_id = persons.id
                               WHERE persons.id = 2
                               ');

$stmtMaxCityAmount = $dbh->query('SELECT cities.name, count(*) from transactions 
                                            JOIN  persons ON persons.id = transactions.from_person_id
                                            JOIN cities ON cities.id = persons.city_id
                                            GROUP BY cities.id');

$stmtSingularCityTransactions = $dbh->query('SELECT * FROM transactions');

echo '<h4>а) написать запрос, который бы выводил полное имя и баланс человека на данный момент</h4>';
while ($row = $stmt->fetch())
{
    echo '<h2>Имя: ' . $row['fullName'] . '</h2>';
    echo '<p>Сумма: ' . $row['SUM(transactions.amount)'] . '</p>';
}

// Можно было еще сделать подзапрос но это скорее всего будет дольше по времени ( И лучше сделать вычисления на машине рабочей )
echo '<brbr><pre>';
echo '<h4>б) Написать запрос, который бы выводил город, представители которого участвовали в передаче денег наибольшее количество раз</h4>';
$countMaxCityAmount = 0;
$nameMaxCityAmount = [];
while ( $rowMaxCityAmount = $stmtMaxCityAmount->fetch() )
{
   if ( $rowMaxCityAmount['count(*)'] >= $countMaxCityAmount ) {
    $countMaxCityAmount = $rowMaxCityAmount['count(*)'];
    $nameMaxCityAmount[$rowMaxCityAmount['name']] = $rowMaxCityAmount['count(*)'];
   }
}

foreach ( $nameMaxCityAmount as $nameMaxCityAmountKey => $nameMaxCityAmountItem ) {
    if ( $nameMaxCityAmountItem == $countMaxCityAmount )
        echo 'Город в топе: ' . $nameMaxCityAmountKey . '<br>';
}

echo '<p>Количество: ' .$countMaxCityAmount . '</p>';

echo '<brbr><pre>';
echo '<h4>в) написать запрос, отражающий все транзакции, где передача денег осуществлялась между представителями одного города</h4>';

foreach ( $stmtSingularCityTransactions as $stmtSingularCityTransactionstKey => $stmtSingularCityTransactionsItem ) {

     $toPersonId = $dbh->query('SELECT * FROM persons 
                                         JOIN cities ON cities.id = persons.city_id
                                         WHERE persons.id =' . $stmtSingularCityTransactionsItem['to_person_id']);

    $fromPersonId = $dbh->query('SELECT * FROM persons 
                                         JOIN cities ON cities.id = persons.city_id
                                         WHERE persons.id =' . $stmtSingularCityTransactionsItem['from_person_id']);

    $fromPersonIdSource = $fromPersonId->fetch();
    $toPersonIdSource = $toPersonId->fetch();

     if ($fromPersonIdSource['city_id'] == $toPersonIdSource['city_id']) {

         echo '<h4>Город: ' . $toPersonIdSource['name'] . '</h4>';
         echo 'транзакция -> ';

         print_r($stmtSingularCityTransactionsItem);
     }
}


?>