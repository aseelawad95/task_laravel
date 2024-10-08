import { createApp } from 'vue'; // Use createApp for Vue 3
import productComponent from './components/productComponent.vue';

// Create a new Vue app
const app = createApp({});

// Register the component
app.component('product-component', productComponent);

// Mount the app to the DOM element with the id 'app'
app.mount('#app');