<template>
    <div class="weather-container">
        <h1 class="city-name">Four Day Weather Forecast in {{ currentCity }}</h1>
        <LoadingSpinner v-if="loading"/>
        <div v-else class="weather-details">
            <div class="temp-switch">
                <label>
                    <input type="radio" value="C" v-model="tempUnit" /> °C
                </label>
                <label>
                    <input type="radio" value="F" v-model="tempUnit" /> °F
                </label>
            </div>
            <div class="day-switch">
                <button v-for="(day, index) in days" :key="index" @click="selectDay(index)" :class="{ active: selectedDayIndex === index }">
                    {{ formatDay(day.date) }}
                </button>
            </div>
            <div class="forecast-row">
                <div v-for="forecast in selectedDayWeather" :key="forecast.dt" class="forecast-item">
                    <div class="forecast-date">{{ formatDate(forecast.dt_txt) }}</div>
                    <div class="forecast-description">{{ forecast.weather[0].description }}</div>
                    <div class="forecast-temp">{{ convertTemperature(forecast.main.temp) }}°{{ tempUnit }}</div>
                    <div class="forecast-icon">
                        <img :src="getWeatherIcon(forecast.weather[0].icon)" alt="Weather Icon" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../api.js';
import LoadingSpinner from './LoadingSpinner.vue';

export default {
    data() {
        return {
            currentCity: 'Tokyo',
            weather: null,
            tempUnit: 'C',
            selectedDayIndex: 0,
            loading: true,
        };
    },
    components: {
        LoadingSpinner
    },
    computed: {
        days() {
            if (!this.weather) return [];
            const groupedByDay = this.weather.list.reduce((acc, forecast) => {
                const date = forecast.dt_txt.split(' ')[0];
                if (!acc[date]) acc[date] = [];
                acc[date].push(forecast);
                return acc;
            }, {});
            return Object.keys(groupedByDay).slice(0, 4).map(date => ({
                date,
                forecasts: groupedByDay[date]
            }));
        },
        selectedDayWeather() {
            return this.days[this.selectedDayIndex]?.forecasts || [];
        }
    },
    props: {
        city: {
            type: String,
            default: 'Tokyo',
        },

    },

    methods: {
        async getWeather() {
            this.loading = true;
            try {
                const response = await api.get(`/weather/${this.currentCity}`);
                this.weather = response.data;
            } catch (error) {
                console.error('API Call Error:', error.response ? error.response.data : error.message);
            } finally {
                this.loading = false;
            }
        },
        formatDate(dateString) {
            const options = {
                weekday: 'short',
                hour: '2-digit',
                minute: '2-digit'
            };
            return new Date(dateString).toLocaleString(undefined, options);
        },
        formatDay(dateString) {
            const options = { weekday: 'long' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        },
        getWeatherIcon(iconCode) {
            return `http://openweathermap.org/img/wn/${iconCode}@2x.png`;
        },
        convertKelvinToCelsius(kelvin) {
            return (kelvin - 273.15).toFixed(2);
        },
        convertKelvinToFahrenheit(kelvin) {
            return ((kelvin - 273.15) * 9/5 + 32).toFixed(1);
        },
        convertTemperature(kelvin) {
            return this.tempUnit === 'C' ? this.convertKelvinToCelsius(kelvin) : this.convertKelvinToFahrenheit(kelvin);
        },
        selectDay(index) {
            this.selectedDayIndex = index;
        }
    },
    mounted() {
        this.getWeather();
    },
    watch: {
        city(newCity) {
            this.currentCity = newCity;
            this.getWeather();
        }
    },
    created() {
        this.currentCity = this.city;

    }
};
</script>

<style scoped>
.weather-container {
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    width: 100%;
}

.city-name {
    text-align: center;
    color: #333;
    font-size: 2em;
    margin-bottom: 20px;
}

.weather-details {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.temp-switch {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
}

.temp-switch label {
    font-size: 1.2em;
    color: #333;
}

.forecast-row {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 10px;
}

.forecast-item {
    flex: 0 0 auto;
    width: 150px;
    padding: 15px;
    background: #d3d3d3;
    border: 1px solid #ccc;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.forecast-date,
.forecast-description,
.forecast-temp {
    margin-bottom: 10px;
    color: #333;
}

.forecast-icon {
    display: flex;
    justify-content: center;
    align-items: center;
}

.forecast-icon img {
    width: 50px;
    height: 50px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    border-radius: 50%;
}

.day-switch {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
}

.day-switch button {
    padding: 10px 20px;
    background-color: #d3d3d3;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.day-switch button.active {
    background-color: #a9a9a9;
    font-weight: bold;
}

@media (max-width: 768px) {
    .forecast-row {
        flex-wrap: wrap;
        justify-content: center;
    }

    .forecast-item {
        flex: 1 1 100%;
        max-width: 100%;
    }

    .temp-switch {
        flex-direction: column;
        align-items: center;
    }

    .day-switch {
        flex-direction: column;
        align-items: center;
    }

    .day-switch button {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>
