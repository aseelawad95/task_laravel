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

        <!-- عرض العروض المقدمة على المنتج -->
        <div v-if="selectedProductOffers.length > 0">
            <h2>Offers for {{ selectedProductName }}</h2>
            <ul>
                <li v-for="offer in selectedProductOffers" :key="offer.id">
                    Buyer: {{ offer.buyer.name }} - Offer Price: {{ offer.price }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            products: [], // قائمة المنتجات
            filters: {
                seller: '', // فلترة المنتجات حسب اسم البائع
                product: '', // فلترة المنتجات حسب اسم المنتج
            },
            isSeller: false, // يتم تعيين هذا بناءً على نوع المستخدم
            currentUser: {}, // بيانات المستخدم الحالي
            selectedProductOffers: [], // العروض الخاصة بالمنتج الذي تم اختياره
            selectedProductName: '', // اسم المنتج الذي يتم عرض العروض الخاصة به
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
        fetchProducts() {
            // جلب المنتجات من الـ API
            axios.get('/api/products').then((response) => {
                this.products = response.data;
            });
        },
        createProduct() {
            // توجيه المستخدم إلى صفحة إنشاء المنتج
            window.location.href = '/create-product';
        },
        makeOffer(productId) {
            const offerPrice = prompt('Enter your offer price:');
            if (offerPrice) {
                // إرسال عرض السعر إلى السيرفر
                axios
                    .post(`/api/products/${productId}/offers`, { price: offerPrice })
                    .then(() => {
                        alert('Offer submitted successfully');
                    });
            }
        },
        viewOffers(productId) {
            // جلب العروض الخاصة بالمنتج
            axios.get(`/api/products/${productId}/offers`).then((response) => {
                this.selectedProductOffers = response.data;
                const product = this.products.find((prod) => prod.id === productId);
                this.selectedProductName = product ? product.name : '';
            });
        },
    },
    mounted() {
        // جلب المنتجات عند تحميل الصفحة
        this.fetchProducts();

        // جلب بيانات المستخدم الحالي للتحقق من نوعه (مشتري أو بائع)
        axios.get('/api/user').then((response) => {
            this.currentUser = response.data;
            this.isSeller = this.currentUser.type === 'seller';
        });
    },
};
</script>
