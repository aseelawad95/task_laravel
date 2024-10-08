import Vue from 'vue';
import Router from 'vue-router';
import CreateProduct from '../components/CreateProduct.vue';

Vue.use(Router);

export default new Router({
    routes: [
        
            { path: '/products', component: productComponent }

        
    ]
});
