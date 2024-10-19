<template>
    <div>
        <h1>Products</h1>
        <div>
            <input
                v-model="filters.seller"
                placeholder="Filter by seller name"
            />
            <input
                v-model="filters.product"
                placeholder="Filter by product name"
            />
        </div>
        <button v-if="isSeller" @click="createProduct">Create Product</button>

        <ul>
            <li v-for="product in filteredProducts" :key="product.id">
                {{ product.name }} - Sold by: {{ product.seller.name }}
                <li>{{ product.description }}</li>
            </li>
        </ul>

       
    </div>
</template>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
export default {
    data() {
        return {
            products: [],
            filters: {
                seller: "",
                product: "",
            },
            isSeller: false,
            currentUser: {},
            selectedProductName: "",
        };
    },
    computed: {
        filteredProducts() {
            return this.products.filter((product) => {
                return (
                    product.name
                        .toLowerCase()
                        .includes(this.filters.product.toLowerCase()) &&
                    product.seller.name
                        .toLowerCase()
                        .includes(this.filters.seller.toLowerCase())
                );
            });
        },
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await fetch("/api/products");
                const data = await response.json();  
                this.products = data;
            } catch (error) {
                console.error("Error fetching products:", error);
                alert("Failed to fetch products.");
            }
        },
        createProduct() {
            window.location.href = "/create-product";
        },
    },
    async mounted() {
        await this.fetchProducts();
    },
};
</script>
