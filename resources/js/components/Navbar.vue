<template>
    <nav class="navbar">
        <div class="navbar-brand">
            <span class="navbar-title"><icon></icon>Wander Japan</span>
        </div>
        <div class="navbar-toggle" @click="toggleMenu">
            <span class="navbar-icon">&#9776;</span>
        </div>
        <div :class="['navbar-links', { 'navbar-links--open': isMenuOpen }]">
            <a v-for="city in cities" :key="city" href="#" class="navbar-link"
                :class="{ 'navbar-link--selected': selectedCity === city }" @click="selectCity(city)">
                {{ city }}
            </a>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            selectedCity: 'Tokyo',
            cities: ['Tokyo', 'Yokohama', 'Kyoto', 'Osaka', 'Sapporo', 'Nagoya'],
            isMenuOpen: false
        };
    },
    methods: {
        selectCity(city) {
            this.selectedCity = city;
            this.$emit('citySelected', city);
        },
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        }
    }
};
</script>

<style scoped>
/* Reset body and html padding and margin */
body, html {
    margin: 0;
    padding: 0;
    width: 100%;
}

/* Ensure the navbar spans the full width */
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 1000;
    width: 100%; /* Ensure the navbar spans the full width */
}

.navbar-brand {
    display: flex;
    align-items: center;
}

.navbar-title {
    font-size: 1.5rem;
    font-weight: bold;
}

.navbar-links {
    display: flex;
    gap: 2rem;
    color: #4a4a4a;
    font-size: 1.125rem;
}

.navbar-link {
    color: inherit;
    text-decoration: none;
}

.navbar-link:hover {
    color: #6b7280;
}

.navbar-link--selected {
    font-weight: bold;
    color: #000;
}

.navbar-actions {
    display: flex;
    gap: 1rem;
}

.navbar-search {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.navbar-icon {
    color: #4a4a4a;
}

.navbar-search-text {
    color: #4a4a4a;
}

.navbar-signin {
    border: 1px solid #4a4a4a;
    color: #4a4a4a;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
}

.navbar-toggle {
    display: none;
    cursor: pointer;
}

@media (max-width: 768px) {
    .navbar {
        flex-wrap: wrap;
    }

    .navbar-links {
        display: none;
        flex-direction: column;
        width: 100%;
        text-align: center;
        gap: 1rem;
        padding: 1rem 0;
    }

    .navbar-links--open {
        display: flex;
    }

    .navbar-actions {
        width: 100%;
        justify-content: center;
        margin-top: 1rem;
    }

    .navbar-toggle {
        display: block;
    }
}
</style>
