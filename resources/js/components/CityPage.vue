<template>
    <div>
        <div :class="['hero-section', selectedCity.toLowerCase()]">
            <h1 class="city-name">{{ selectedCity }}</h1>
        </div>
        <div class="content">
            <WeatherDetails :city="selectedCity" class="weather-details" />
            <PlaceInformation :city="selectedCity" class="place-information" />
        </div>
    </div>
</template>

<script>
import WeatherDetails from './WeatherDetails.vue';
import PlaceInformation from './PlaceInformation.vue';
export default {
    components: {
        WeatherDetails,
        PlaceInformation,
    },
    props: {
        selectedCity: {
            type: String,
            required: true
        }
    },
    computed: {
        city() {
            return this.$route.params.name;
        }
    },
    mounted() {
    }
};
</script>

<style scoped>
.hero-section {
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 2.5em;
    background-size: cover;
    background-position: center;
    margin-top: 7rem;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.hero-section.tokyo {
    background-image: url('/images/tokyo.jpg');
}
.hero-section.yokohama {
    background-image: url('/images/yokohama.jpg');
}
.hero-section.kyoto {
    background-image: url('/images/kyoto.jpg');
}
.hero-section.osaka {
    background-image: url('/images/osaka.jpg');
}
.hero-section.sapporo {
    background-image: url('/images/sapporo.jpg');
}
.hero-section.nagoya {
    background-image: url('/images/nagoya.png');
}

.city-name {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    padding: 2rem;
}

.weather-details {
    margin-bottom: 0.1rem;
}

.place-information {
    margin-top: 0.1rem;
}
</style>
