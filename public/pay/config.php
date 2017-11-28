<?php

class Config
{
    // Ваш секретный ключ (из настроек проекта в личном кабинете cp.gdonate.ru )
    const SECRET_KEY = '6705e45de12d1ea0854a3580f52ebcaa';
    // Стоимость товара в руб.
    const ITEM_PRICE = 1;

    // Таблица начисления товара, например `users`
    const TABLE_ACCOUNT = 'users';
    // Название поля из таблицы начисления товара по которому производится поиск аккаунта/счета, например `email`
    const TABLE_ACCOUNT_NAME = 'steamid64';
    // Название поля из таблицы начисления товара которое будет увеличено на колличево оплаченого товара, например `sum`, `donate`
    const TABLE_ACCOUNT_DONATE= 'money';

    // Параметры соединения с бд
    // Хост
    const DB_HOST = 'localhost';
    // Имя пользователя
    const DB_USER = 'root';
    // Пароль
    const DB_PASS = 'Q0e2G6i6';
    // Назывние базы
    const DB_NAME = 'csgo';
}