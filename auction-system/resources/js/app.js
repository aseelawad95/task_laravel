import { createApp } from 'vue';
import ProductComponent from './components/productComponent.vue'; 

const app = createApp({});

app.component('product-component', ProductComponent);
app.mount('#app');
