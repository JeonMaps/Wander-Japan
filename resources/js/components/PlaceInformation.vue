<template>
    <div class="row">
        <div class="category-icons">
            <div v-for="category in categories" :key="category.name" @click="searchPlaces(category)"
                :class="['category-icon', { 'selected': category.name === selectedCategory }]">
                <i :class="category.icon"></i>
                <span>{{ category.name }}</span>
            </div>
        </div>
        <LoadingSpinner v-if="loading" />
        <div v-else :class="['col-md-6', { 'col-md-12': !selectedVenueId }]">
            <div v-if="places.length" class="places-container">
                <h1>{{ selectedCategory }} in {{ city }}</h1>
                <ul class="list-group">
                    <li v-for="place in places" :key="place.fsq_id" @click="selectPlace(place.fsq_id)"
                        class="list-group-item">
                        {{ place.name }}
                    </li>
                </ul>
            </div>
            <div v-else class="no-places-container">
                <p>Select one of the categories!</p>
            </div>
        </div>
        <div class="col-md-6" v-if="selectedVenueId">
            <VenueDetails ref="venueDetails" :venueId="selectedVenueId" />
        </div>
    </div>
</template>

<script>
import api from '../api.js';
import VenueDetails from './VenueDetails.vue';
import LoadingSpinner from './LoadingSpinner.vue';

export default {
    components: {
        VenueDetails,
        LoadingSpinner
    },
    props: {
        city: {
            type: String,
            required: true
        }
    },
    watch: {
        city(newCity, oldCity) {
            this.resetValues();
        }
    },
    data() {
        return {
            places: [],
            selectedVenueId: null,
            selectedCategory: null,
            loading: false,
            near: '',
            limit: 20,
            categories: [
                { name: 'Amusement Parks', icon: 'ri-bear-smile-line', category_id: '4bf58dd8d48988d182941735' },
                { name: 'Attractions', icon: 'ri-hotel-line', category_id: '5109983191d435c0d71c2bb1' },
                { name: 'Cafes', icon: 'ri-cup-line', category_id: '4bf58dd8d48988d1e0931735' },
                { name: 'Hotels', icon: 'ri-hotel-bed-line', category_id: '4bf58dd8d48988d1fa931735' },
                { name: 'Gaming Cafes', icon: 'ri-gamepad-line', category_id: '4bf58dd8d48988d18d941735' },
                { name: 'Malls', icon: 'ri-store-3-line', category_id: '5744ccdfe4b0c0459246b4df' },
                { name: 'Museums', icon: 'ri-artboard-line', category_id: '4bf58dd8d48988d181941735' },
                { name: 'Parks', icon: 'ri-tree-line', category_id: '4bf58dd8d48988d163941735' },

            ]
        };
    },
    computed: {
        categorizedPlaces() {
            const categorized = {};
            this.categories.forEach(category => {
                categorized[category.name] = this.places.filter(place => place.category === category.name);
            });
            return categorized;
        }
    },
    methods: {
        async searchPlaces(category) {
            this.loading = true;
            this.places = [];
            this.selectedVenueId = null;
            this.selectedCategory = category.name
            try {
                const response = await api.get('/places/search', {
                    params: {
                        near: `${this.city}, Japan`,
                        categories: category.category_id,
                        limit: this.limit
                    }
                });
                const places = response.data.results.map(place => ({
                    ...place,
                    category: this.categories.find(category => category.category_id === category.category_id).name
                }));
                this.places.push(...places);
            } catch (error) {
                console.error(`Error fetching places for category ${category.name}:`, error);
            } finally {
                this.loading = false;
            }
        },
        selectPlace(venueId) {
            this.selectedVenueId = venueId;
            this.$nextTick(() => {
                const venueDetailsElement = this.$refs.venueDetails.$el;
                if (venueDetailsElement) {
                    venueDetailsElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        },
        resetValues() {
            this.selectedVenueId = null;
            this.selectedCategory = null;
            this.places = [];
        }
    }
};
</script>

<style scoped>
.category-icons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.category-icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100px;
    height: 120px;
    margin: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.2s;
}

.category-icon:hover {
    transform: scale(1.05);
}

.category-icon i {
    font-size: 2em;
    margin-bottom: 10px;
}

.category-name {
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
}

.category-icon.selected {
    border-color: #007bff;
    background-color: #e7f1ff;
}

.category-section {
    margin-bottom: 20px;
}

.places-container {
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    width: 100%;
}

.list-group {
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-group-item {
    padding: 15px;
    background: #d3d3d3;
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.list-group-item:hover {
    background-color: #a9a9a9;
}

.no-places-container {
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}
</style>
