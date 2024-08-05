<!-- <template>
    <div class="app-container">
        <nav class="navbar">
            <div class="navbar-title">Weather & Places Info</div>
            <ul class="navbar-menu">
                <li v-for="city in cities" :key="city" :class="{ active: city === selectedCity }">
                    <a href="#" @click.prevent="selectCity(city)">{{ city }}</a>
                </li>
            </ul>
        </nav>
        <main class="main-content">
            <div class="info-container">
                <div class="weather-column">
                    <WeatherDetails :city="selectedCity" />
                </div>
                <div class="places-column">
                    <PlaceInformation :city="selectedCity" />
                </div>
            </div>
        </main>
    </div>
</template> -->

<template>

</template>
<script>
import WeatherDetails from './WeatherDetails.vue';
import PlaceInformation from './PlaceInformation.vue';

export default {
    components: {
        WeatherDetails,
        PlaceInformation,
    },
    data() {
        return {
            cities: ['Tokyo', 'Yokohama', 'Kyoto', 'Osaka', 'Sapporo', 'Nagoya'],
            cities: [
                {
                    name: 'Tokyo',
                    image: 'path/to/tokyo.jpg',
                    description: 'The bustling capital city of Japan, known for its skyscrapers, shopping, and food.'
                },
                {
                    name: 'Yokohama',
                    image: 'path/to/Yokohama.jpg',
                    description: 'Famous for its classical Buddhist temples, as well as gardens, imperial palaces, Shinto shrines, and traditional wooden houses.'
                },
                {
                    name: 'Kyoto',
                    image: 'path/to/Kyoto.jpg',
                    description: 'Known for its modern architecture, nightlife, and hearty street food.'
                },
                {
                    name: 'Osaka',
                    image: 'path/to/Osaka.jpg',
                    description: 'The bustling capital city of Japan, known for its skyscrapers, shopping, and food.'
                },
                {
                    name: 'Sapporo',
                    image: 'path/to/Sapporo.jpg',
                    description: 'Famous for its classical Buddhist temples, as well as gardens, imperial palaces, Shinto shrines, and traditional wooden houses.'
                },
                {
                    name: 'Nagoya',
                    image: 'path/to/Nagoya.jpg',
                    description: 'Known for its modern architecture, nightlife, and hearty street food.'
                }
            ],
            selectedCity: 'Tokyo',
        };
    },
    methods: {
        selectCity(city) {
            this.selectedCity = city;
        },
    },
};
</script>

<!-- <style scoped>
.app-container {
    font-family: Arial, sans-serif;
}

.navbar {
    background-color: #333;
    color: white;
    padding: 10px;
}

.navbar-title {
    font-size: 1.5em;
}

.navbar-menu {
    list-style-type: none;
    padding: 0;
    display: flex;
}

.navbar-menu li {
    margin-right: 20px;
}

.navbar-menu li a {
    color: white;
    text-decoration: none;
}

.navbar-menu li.active a {
    font-weight: bold;
}

.main-content {
    padding: 20px;
}

.info-container {
    display: flex;
    max-width: 1200px;
    margin: 0 auto;
    gap: 20px;
}

.weather-column {
    flex: 2;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.places-column {
    flex: 10;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style> -->
