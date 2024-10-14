<template>
    <div>
        <h1>Products</h1>
        <div>
            <!-- قسم الفلاتر -->
            <input v-model="filters.seller" placeholder="Filter by seller name" />
            <input v-model="filters.product" placeholder="Filter by product name" />
        </div>
        <!-- زر إنشاء المنتج الذي يظهر فقط للبائعين -->
        <button v-if="isSeller" @click="createProduct">Create Product</button>

        <!-- قائمة المنتجات مع عرض الخيارات المتاحة -->
        <ul>
            <li v-for="product in filteredProducts" :key="product.id">
                {{ product.name }} - Sold by: {{ product.seller.name }}
                <button @click="makeOffer(product.id)">Make Offer</button> <!-- زر إرسال عرض سعر -->
                <!-- إذا كنت مالك المنتج، عرض العروض الخاصة بهذا المنتج -->
                <button v-if="isSeller && product.seller.id === currentUser.id" @click="viewOffers(product.id)">
                    View Offers
                </button>
            </li>
        </ul>

        <!-- إذا لم توجد منتجات، عرض رسالة -->
        <p v-if="filteredProducts.length === 0">No products available.</p>

        <!-- عرض العروض المقدمة على المنتج -->
        <!-- <div v-if="selectedProductOffers.length > 0">
            <h2>Offers for {{ selectedProductName }}</h2>
            <ul>
                <li v-for="offer in selectedProductOffers" :key="offer.id">
                    Buyer: {{ offer.buyer.name }} - Offer Price: {{ offer.price }}
                </li>
            </ul>
        </div> -->
    </div>
</template>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [],
            filters: {
                seller: '',
                product: '',
            },
            isSeller: false,
            currentUser: {},
            selectedProductOffers: [],
            selectedProductName: '',
        };
    },
    computed: {
        filteredProducts() {
            return this.products.filter((product) => {
                return (
                    product.name.toLowerCase().includes(this.filters.product.toLowerCase()) &&
                    product.seller.name.toLowerCase().includes(this.filters.seller.toLowerCase())
                );
            });
        },
    },
    methods: {
        async fetchProducts() {
            try {

                const response = await axios.get('/api/products');
                this.products = response.data;
            } catch (error) {
                console.error('Error fetching products:', error);
                alert('Failed to fetch products.');
            }
        },
        createProduct() {
            window.location.href = '/create-product';
        },
        async makeOffer(productId) {
            const offerPrice = prompt('Enter your offer price:');
            if (offerPrice) {
                try {
                    await axios.post(`/api/products/${productId}/offers`, { price: offerPrice });
                    alert('Offer submitted successfully');
                } catch (error) {
                    console.error('Error submitting offer:', error);
                    alert('Failed to submit offer.');
                }
            }
        },
        async viewOffers(productId) {
            try {
                const response = await axios.get(`/api/products/${productId}/offers`);
                this.selectedProductOffers = response.data;
                const product = this.products.find((prod) => prod.id === productId);
                this.selectedProductName = product ? product.name : '';
            } catch (error) {
                console.error('Error fetching offers:', error);
                alert('Failed to fetch offers.');
            }
        },
    },
    async mounted() {
        await this.fetchProducts();

        try {
            const response = await axios.get('/api/user');
            this.currentUser = response.data;
            this.isSeller = this.currentUser.type === 'seller';
        } catch (error) {
            console.error('Error fetching user data:', error);
            alert('Failed to fetch user data.');
        }
    },
};
</script>
