<template>
    <div class="venue-details-container">
        <h1>Details</h1>
        <div v-if="loading">
            <LoadingSpinner />
        </div>
        <div v-else>
            <div v-if="details" class="venue-info">
                <h2>{{ details.name }}</h2>
                <p><strong>Address:</strong> {{ details.location.address }}</p>
                <p><strong>Postcode:</strong> {{ details.location.postcode }}</p>
                <p><strong>Geocode:</strong> {{ details.geocodes.main.latitude }}, {{ details.geocodes.main.longitude }}
                </p>
            </div>
            <div v-else>
                <p>No details available.</p>
            </div>
            <h1>Photos</h1>
            <div>
                <div v-if="photos.length" class="photos-grid">
                    <img v-for="photo in photos" :key="photo.id" :src="getPhotoUrl(photo)" alt="Venue Photo"
                        class="venue-photo" @click="openPopup(photo)" />
                </div>
                <div v-else>
                    <p>No photos available.</p>
                </div>
                <div v-if="showPopup" class="popup" @click="closePopup">
                    <img :src="getPhotoUrl(selectedPhoto)" alt="Zoomed Venue Photo" />
                </div>
            </div>
            <h1>Tips/Reviews</h1>
            <div v-if="tips.length" class="reviews-list">
                <div v-for="tip in tips" :key="tip.id" class="review-item">
                    <p>{{ tip.text }}</p>
                </div>
            </div>
            <div v-else>
                <p>No tips or reviews available.</p>
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
            details: null,
            photos: [],
            tips: [],
            loading: false,
            showPopup: false,
        };
    },
    components: {
        LoadingSpinner
    },
    props: {
        venueId: {
            type: String,
            required: true
        }
    },
    watch: {
        venueId: 'fetchVenueData'
    },
    created() {
        this.fetchVenueData();
    },
    methods: {
        async fetchVenueData() {
            await this.fetchVenueDetails();
            await this.fetchVenuePhotos();
            await this.fetchVenueTips();
        },
        async fetchVenueDetails() {
            this.loading = true;
            try {
                const response = await api.get(`/places/${this.venueId}`);
                this.details = response.data;
            } catch (error) {
                console.error('Error fetching venue details:', error);
            } finally {
                this.loading = false;
            }
        },
        async fetchVenuePhotos() {
            this.loading = true;
            try {
                const response = await api.get(`/places/${this.venueId}/photos`);
                this.photos = response.data;
            } catch (error) {
                console.error('Error fetching venue photos:', error);
            } finally {
                this.loading = false;
            }
        },
        async fetchVenueTips() {
            this.loading = true;
            try {
                const response = await api.get(`/places/${this.venueId}/tips`);
                this.tips = response.data;
            } catch (error) {
                console.error('Error fetching venue tips:', error);
            } finally {
                this.loading = false;
            }
        },
        getPhotoUrl(photo) {
            const url = `${photo.prefix}600x400${photo.suffix}`;
            return url;
        },
        openPopup(photo) {
            this.selectedPhoto = photo;
            this.showPopup = true;
        },
        closePopup() {
            this.showPopup = false;
            this.selectedPhoto = null;
        },
    }
};
</script>

<style scoped>
.venue-details-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 1.8em;
    color: #333;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

h2 {
    font-size: 1.5em;
    color: #007bff;
    margin-bottom: 10px;
}

.venue-info p {
    font-size: 1em;
    color: #555;
    margin: 5px 0;
}

.photos-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.venue-photo {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease;
    cursor: pointer;
}

.venue-photo:hover {
    transform: scale(1.1);
}

.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
}

.reviews-list {
    margin-top: 20px;
}

.review-item {
    background-color: #fff;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
}

.review-item p {
    font-size: 1em;
    color: #555;
    margin: 0;
}
</style>
