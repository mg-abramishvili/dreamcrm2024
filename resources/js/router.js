import { createRouter, createWebHistory } from 'vue-router'

import Home from './components/Home.vue'

import Calculations from './components/calculations/Index.vue'
import CreateCalculation from './components/calculations/Create.vue'

import CatalogBoxes from './components/catalog/boxes/Index.vue'
import CatalogBox from './components/catalog/boxes/Box.vue'

import Catalog from './components/catalog/Index.vue'
import CatalogCategory from './components/catalog/Category.vue'
import CatalogItem from './components/catalog/Item.vue'

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
        path: '/calculations',
        name: 'Calculations',
        component: Calculations
    },
    {
        path: '/calculations/create',
        name: 'CreateCalculation',
        component: CreateCalculation
    },
    {
        path: '/catalog',
        name: 'Catalog',
        component: Catalog
    },
    {
        path: '/catalog/category/:id',
        name: 'CatalogCategory',
        component: CatalogCategory
    },
    {
        path: '/catalog/item/:id',
        name: 'CatalogItem',
        component: CatalogItem
    },
    {
        path: '/catalog/boxes',
        name: 'CatalogBoxes',
        component: CatalogBoxes
    },
    {
        path: '/catalog/box/:id',
        name: 'CatalogBox',
        component: CatalogBox
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