import { createRouter, createWebHistory } from 'vue-router'

import Home from './components/Home.vue'

import Stock from './components/stock/Index.vue'
import StockCategory from './components/stock/Category.vue'
import StockItem from './components/stock/Item.vue'

import Users from './components/users/Index.vue'
import User from './components/users/User.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/stock',
        name: 'Stock',
        component: Stock
    },
    {
        path: '/stock/category/:id',
        name: 'StockCategory',
        component: StockCategory
    },
    {
        path: '/stock/item/:id',
        name: 'StockItem',
        component: StockItem
    },
    {
        path: '/users',
        name: 'Users',
        component: Users
    },
    {
        path: '/user/:id',
        name: 'User',
        component: User
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
})