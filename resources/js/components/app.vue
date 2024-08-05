<template>
    <div class="app-container">
        <header>
            <Navbar @citySelected="updateSelectedCity"/>
        </header>
        <main class="container">
            <CityPage :selectedCity="selectedCity" />
            <router-view></router-view>
        </main>
        <Footer />
    </div>
</template>

<script>
import Navbar from './Navbar.vue';
import CityPage from './CityPage.vue';
import Footer from './Footer.vue';

export default {
    components: {
        Navbar,
        CityPage,
        Footer
    },
    data() {
        return {
            selectedCity: 'Tokyo'
        };
    },
    methods: {
        updateSelectedCity(city) {
            this.selectedCity = city;
        }
    }
};
</script>

<style scoped>

main {
    flex: 1;
    padding: 1rem;
}

.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
