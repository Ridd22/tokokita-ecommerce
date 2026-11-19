<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';
const page=usePage();
const logout=()=>router.post('/logout');
const money=(n)=>new Intl.NumberFormat('id-ID',{style:'currency',currency:'IDR',maximumFractionDigits:0}).format(n||0);
</script>
<template>
<header class="topbar"><div class="container nav"><Link href="/" class="brand">Toko<span>Kita.</span></Link><nav class="navlinks"><Link href="/">Beranda</Link><Link href="/keranjang">Keranjang ({{ page.props.cartCount || 0 }})</Link><template v-if="page.props.auth?.user"><Link href="/pesanan">Pesanan Saya</Link><Link v-if="page.props.auth.user.role==='admin'" href="/admin">Admin</Link><button class="btn light" @click="logout">Keluar</button></template><template v-else><Link href="/login">Masuk</Link><Link class="btn" href="/register">Daftar</Link></template></nav></div></header>
<main class="container"><div v-if="page.props.flash?.success" class="alert">{{ page.props.flash.success }}</div><slot /></main><footer class="footer">© {{ new Date().getFullYear() }} TokoKita · Belanja mudah, nyaman, dan aman.</footer>
</template>
