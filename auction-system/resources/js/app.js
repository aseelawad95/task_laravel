import { createApp } from 'vue';
import ProductComponent from './components/productComponent.vue'; 
import ProductsList from './components/productComponent.vue'; 

const app = createApp({});

app.component('product-component', ProductComponent);
// app.component('products-list', ProductsList); 
app.mount('#app');
