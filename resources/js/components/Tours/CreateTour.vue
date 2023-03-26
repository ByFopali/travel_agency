<template>

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="row w-50">
            <div class="col-12 mt-3 d-block mx-auto">
                <form @submit.prevent="saveTour" enctype="multipart/form-data">
                    <router-link class="nav-item nav-link" to="/tours" style="color: #8312FA;">
                        <span>Back</span>
                    </router-link>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" placeholder="Tour name" v-model="tour.name">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" aria-label="Price" v-model="tour.price">
                        <span class="input-group-text">.00</span>
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control">
                        <label class="input-group-text">Upload</label>
                    </div>

                    <select class="form-select mb-3" v-model="tour.place_id">
                        <option>Select place</option>
                        <option v-for="place in places" :value="place.id"> {{ place.name }}, {{ place.country.name }}
                        </option>
                    </select>

                    <select class="form-select mb-3" v-model="tour.discount_id">
                        <option>Select available discount</option>
                        <option v-for="discount in discounts" :value="discount.id"> {{ discount.size }}%</option>
                    </select>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <textarea class="form-control" rows="8" v-model="tour.description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-25">Save</button>

                </form>

            </div>
        </div>

        <div class="alert alert-danger" role="alert" v-if="errored">
            Помилка, спробуйте ще раз!
        </div>

        <div class="position-fixed top-50 start-50 translate-middle">
            <div class="spinner-border text-info" role="status" v-if="loader">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {

            tour: {
                name: '',
                price: null,
                description: '',
                image: null,
                place: {
                    id: null,
                },
                discount: {
                    id: null,
                },
            },

            places: [],
            discounts: [],
            errored: false,
            loader: true,
        };
    },
    methods: {
        saveTour() {
            axios.post('/api/tours', this.tour)
                .then(response => {
                    // console.log(this.tour)
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.loader = false
                })
        },
        getPlaces() {
            axios.get('/api/places')
                .then(response => {
                    // this.places = response.data.data
                    // console.log(this.places)
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.loader = false
                })
        },
        getDiscounts() {
            axios.get('/api/discounts')
                .then(response => {
                    // this.discounts = response.data.data
                    // console.log(this.discounts)
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.loader = false
                })
        }
    },
    mounted() {
        this.getPlaces()
        this.getDiscounts()
    }
}
</script>

<style scoped>
input:focus {
    outline: none;
    box-shadow: none;
}
select:focus {
    outline: none !important;
    box-shadow: none !important;
}
</style>
