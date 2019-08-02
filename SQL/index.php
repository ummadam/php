<?php

$host = '127.0.0.1';
$db   = 'homeworkdb';
$user = 'admin';
$pass = 'dinara280690';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

#Task1
/*Получить из таблицы employees все записи,
только поля first_name и last_name представить в виде
“First Name" и "Last Name" соответственно.
*/
$stmt = $pdo->prepare("
    SELECT `EMPLOYEE_ID`, `FIRST_NAME` AS `First Name`, `LAST_NAME` AS `Last Name`, `EMAIL`,
     `PHONE_NUMBER`, `HIRE_DATE`, `JOB_ID`, `SALARY`, `COMMISSION_PCT`, 
     `MANAGER_ID`, `DEPARTMENT_ID`  
    FROM `employees`;
    
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task2
/*Получить только уникальные department_id из таблицы employees.*/

$stmt = $pdo->prepare("
    SELECT  DISTINCT `DEPARTMENT_ID` 
    FROM `employees`;    
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task3
/*Получить все записи из таблицы employees отсортированное по имени в порядке убывания.*/

$stmt = $pdo->prepare("
    SELECT  * 
    FROM `employees`
    ORDER BY `FIRST_NAME` DESC;
    
    
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task4
/*
Получить employee ID, полное имя и зарплату, отсортированные по зарплате в порядке возрастания.*/

$stmt = $pdo->prepare("
        SELECT `EMPLOYEE_ID`, `FIRST_NAME`, `LAST_NAME`, `SALARY`
        FROM `employees`
        ORDER BY `SALARY` ASC
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task5
/* Получить общую зарплату, выдаваемую работникам.*/

$stmt = $pdo->prepare("
        SELECT SUM(`SALARY`) AS `Amount of Salary`
        FROM `employees`
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task6
/*Получить работников с максимальной и минимальной зарплатами.*/

$stmt = $pdo->prepare("
        SELECT `EMPLOYEE_ID`, `FIRST_NAME`, `LAST_NAME`, `SALARY` AS `Min-Max Salary`
        FROM `employees`
        WHERE `SALARY`=(SELECT MIN(`SALARY`) FROM `employees`)
        OR `SALARY`=(SELECT MAX(`SALARY`) FROM `employees`)
        

");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task7
/*Получить количество работников.*/
$stmt = $pdo->prepare("
        SELECT COUNT(`EMPLOYEE_ID`) AS `Amount of employees`
        FROM `employees`
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task8
/*Получить количество доступных должностей из таблицы employees*/

$stmt = $pdo->prepare("
        SELECT COUNT(DISTINCT `JOB_ID`)
        FROM `employees`
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task9
/*Получить первые 10 записей из таблицы employees*/

$stmt = $pdo->prepare("
        SELECT *
        FROM `employees`
        LIMIT 10
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task 10
/* Получить имя и зарплату всех работников, зарплата которых больше $10000 и меньше $15000*/

$stmt = $pdo->prepare("
        SELECT `FIRST_NAME`, `SALARY`
        FROM `employees`
        WHERE `SALARY` BETWEEN 10000 AND 15000
");

$stmt->execute();
//print_r($stmt->fetchALL());
 
#Task11
/*Получить имя и department ID, всех работников отделов(department) 30 и 100*/

$stmt = $pdo->prepare("
        SELECT `FIRST_NAME`, `DEPARTMENT_ID`
        FROM `employees`
        WHERE `DEPARTMENT_ID` = 30 OR `DEPARTMENT_ID` =100
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task12
/*Совместить запросы из заданий 10 и 11*/

$stmt = $pdo->prepare("
    SELECT `FIRST_NAME`, `SALARY`,`DEPARTMENT_ID`
    FROM `employees`
    WHERE `SALARY` BETWEEN 10000 AND 15000
    UNION ALL
    SELECT `FIRST_NAME`,`SALARY`, `DEPARTMENT_ID`
    FROM `employees`
    WHERE `DEPARTMENT_ID` = 30 OR `DEPARTMENT_ID` =100
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task13
/*Получить имя и дату найма всех работников, которых наняли в 1987 году*/

$stmt = $pdo->prepare("
        SELECT `FIRST_NAME`, `HIRE_DATE`
        FROM `employees`
        WHERE `HIRE_DATE` LIKE '1987%'
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task14
/* Получить фамилию, должность и зарплату всех работников, 
должность которых Программист (IT_PROG) и чья зарплата не 
равняется $4500, $10000 или $15000*/

$stmt = $pdo->prepare("
        SELECT `LAST_NAME`,`JOB_ID`,`SALARY`
        FROM `employees`
        WHERE `JOB_ID` = :job AND `SALARY` NOT IN (4200,4500,15000)
");

$stmt->execute([
    ':job' => 'IT_PROG',
]);
//print_r($stmt->fetchALL());

#Task15
/*Получить список уникальных должностей*/

$stmt = $pdo->prepare("
        SELECT DISTINCT `JOB_ID`
        FROM `employees`
       
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task16
/*Получить список всех работников с фамилиями Blake, Scott, King, Ford*/

$stmt = $pdo->prepare("
        SELECT `LAST_NAME`,`FIRST_NAME`
        FROM `employees`
        WHERE `LAST_NAME` IN ('Blake','Scott','King','Ford')
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task17
/*Получить среднюю зарплату и общее количество работников*/

$stmt = $pdo->prepare("
        SELECT AVG(`SALARY`),COUNT(`EMPLOYEE_ID`)
        FROM `employees`
        
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task18
/*Получить количество работников по каждой должности*/

$stmt = $pdo->prepare("
        SELECT `JOB_ID`, COUNT(`EMPLOYEE_ID`)
        FROM `employees`
        GROUP BY `JOB_ID`
        
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task19
/*Получить разницу между максимальной и минимальной зарплатой*/

$stmt = $pdo->prepare("
        SELECT MAX(`SALARY`) - MIN(`SALARY`)
        FROM `employees`
        
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task20
/*Получить все department ID и общую сумму зарплат, выплачиваемых в каждом department*/

$stmt = $pdo->prepare("
        SELECT `DEPARTMENT_ID`, SUM(`SALARY`)
        FROM `employees`
        GROUP BY `DEPARTMENT_ID`
        
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task21
/*Получить среднюю зарплату для каждой должности, кроме Программист(IT_PROG)*/

$stmt = $pdo->prepare("
        SELECT `JOB_ID`, AVG(`SALARY`)
        FROM `employees`
        WHERE `JOB_ID` NOT IN ('IT_PROG')
        GROUP BY `JOB_ID`
        
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task22
/*Получить общую зарплату, среднюю зарплату, а также максимальную и 
минимальную зарплату всех работников с department ID = 90 (из отдела 90?), по их должности*/

$stmt = $pdo->prepare("
        SELECT `JOB_ID`,COUNT(`EMPLOYEE_ID`), SUM(`SALARY`),AVG(`SALARY`),MAX(`SALARY`), MIN(`SALARY`)
        FROM `employees`
        WHERE `DEPARTMENT_ID`=90
        GROUP BY `JOB_ID`
        
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task23
/*Получить среднюю зарплату всех отделов, в которых есть больше 10 работников*/

$stmt = $pdo->prepare("
    SELECT `DEPARTMENT_ID`, AVG(`SALARY`)
    FROM `employees`
    GROUP BY `DEPARTMENT_ID`
    HAVING COUNT(`EMPLOYEE_ID`)>10
        
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task24
/*Получить имена(first_name и last_name) всех работников, а также название отдела и их должность*/

$stmt = $pdo->prepare("
    SELECT `employees`.`FIRST_NAME`,`employees`.`LAST_NAME`,`departments`.`DEPARTMENT_NAME`,`jobs`.`JOB_TITLE`
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    LEFT JOIN `jobs`
    ON `employees`.`JOB_ID` = `jobs`.`JOB_ID`
           
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task25
/*Получить id и имена всех работников, работающих в городе Лондон, вместе с id и названием отдела*/

$stmt = $pdo->prepare("
    SELECT `employees`.`EMPLOYEE_ID`,`employees`.`FIRST_NAME`,`departments`.`DEPARTMENT_ID`,`departments`.`DEPARTMENT_NAME`
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    LEFT JOIN `locations`
    ON `departments`.`LOCATION_ID`=`locations`.`LOCATION_ID`
    WHERE `locations`.`CITY` = 'London'
           
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task26
/*Получить название отдела и количество работников в нём*/

$stmt = $pdo->prepare("
    SELECT `departments`.`DEPARTMENT_NAME`,COUNT(`employees`.`EMPLOYEE_ID`)
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    GROUP BY `departments`.`DEPARTMENT_NAME`
           
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task27
/* Получить среднюю зарплату:
а) во всех отделах
б) по всем должностям*/

$stmta = $pdo->prepare("
    SELECT `departments`.`DEPARTMENT_NAME`, AVG(`employees`.`SALARY`)
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    GROUP BY `departments`.`DEPARTMENT_NAME`           
");

$stmta->execute();
//print_r($stmta->fetchALL());

$stmtb = $pdo->prepare("
    SELECT `jobs`.`JOB_TITLE`, AVG(`employees`.`SALARY`)
    FROM `employees`
    LEFT JOIN `jobs`
    ON `employees`.`JOB_ID` = `jobs`.`JOB_ID`
    GROUP BY `jobs`.`JOB_TITLE`           
");

$stmtb->execute();
//print_r($stmtb->fetchALL());

#Task28
/*Получить отделы, в которых нет работников*/

$stmt = $pdo->prepare("
    SELECT `departments`.`DEPARTMENT_NAME`
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    GROUP BY `departments`.`DEPARTMENT_NAME` 
    HAVING COUNT(`employees`.`EMPLOYEE_ID`)=0          
");

$stmt->execute();
print_r($stmt->fetchALL());

#Task29
/*Получить работников, которые не состоят ни в одном отделе*/

$stmt = $pdo->prepare("
    SELECT `employees`.`FIRST_NAME`
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    WHERE `employees`.`DEPARTMENT_ID` = 0         
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task30
/*имена (first_name и last_name) всех работников, работающих в отделе IT*/

$stmt = $pdo->prepare("
    SELECT `employees`.`FIRST_NAME`, `employees`.`LAST_NAME`,`departments`.`DEPARTMENT_NAME`
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    WHERE `departments`.`DEPARTMENT_NAME` = (SELECT `departments`.`DEPARTMENT_NAME` FROM `departments` WHERE `departments`.`DEPARTMENT_NAME`='IT' )         
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task31
/*имена (first_name и last_name) всех работников, 
у которых есть менеджер и которые работали в отделе, расположенном в США*/

$stmt = $pdo->prepare("
    SELECT `employees`.`FIRST_NAME`, `employees`.`LAST_NAME`,`countries`.`COUNTRY_NAME`
    FROM `employees`
    LEFT JOIN `departments`
    ON `employees`.`DEPARTMENT_ID`=`departments`.`DEPARTMENT_ID`
    LEFT JOIN `locations`
    ON `locations`.`LOCATION_ID`=`departments`.`LOCATION_ID`
    LEFT JOIN `countries`
    ON `locations`.`COUNTRY_ID`=`countries`.`COUNTRY_ID`
    WHERE  `employees`.`MANAGER_ID` !=0 AND `countries`.`COUNTRY_NAME` = (SELECT `countries`.`COUNTRY_NAME` FROM `countries` WHERE `countries`.`COUNTRY_ID`='US' )         
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task32
/*имена (first_name и last_name) всех работников, которые являются менеджерами*/

$stmt = $pdo->prepare("
    SELECT `FIRST_NAME`,`LAST_NAME`,`EMPLOYEE_ID`
    FROM `employees`
    WHERE `employees`.`EMPLOYEE_ID` = ANY (SELECT `MANAGER_ID` FROM `employees` )         
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task33
/*имена (first_name и last_name) всех работников, зарплата которых выше средней*/

$stmt = $pdo->prepare("
    SELECT `FIRST_NAME`,`LAST_NAME`,`SALARY`
    FROM `employees`
    WHERE `SALARY` > (SELECT AVG(`SALARY`) FROM `employees` )         
");

$stmt->execute();
//print_r($stmt->fetchALL());

#Task34
/*имена (first_name и last_name) всех работников, 
зарплата которых выше средней и работающих в любом IT отделе*/

$stmt = $pdo->prepare("
    SELECT `FIRST_NAME`,`LAST_NAME`,`SALARY`,`JOB_ID`
    FROM `employees`
    WHERE `SALARY` > (SELECT AVG(`SALARY`) FROM `employees` ) 
    AND `JOB_ID` = ANY (SELECT `JOB_ID` FROM `employees` WHERE `DEPARTMENT_ID` = 60)        
");

$stmt->execute();
print_r($stmt->fetchALL());
