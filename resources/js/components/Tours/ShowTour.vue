<template>
    <div class="container">
        <div class="row">
            <div class="col-8 d-block mx-auto">

                <router-link class="nav-item nav-link mt-3" to="/tours" style="color: #8312FA;">
                    <span>Back</span>
                </router-link>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">@</span>
                    <input @blur="saveName" type="text" class="form-control" placeholder="Tour name"
                           v-model="tour.name">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input @blur="savePrice" type="number" class="form-control" v-model="tour.price">
                    <span class="input-group-text">.00</span>
                </div>

                <img :src="imageUrl(tour.image)" alt="tour image" class="card-img mt-2">

<!--                <form @submit.prevent="saveImage">-->
<!--                    <input type="file" ref="fileInput" @change="onFileSelected">-->
<!--                    <button type="submit">Upload</button>-->
<!--                </form>-->

                <form @submit.prevent="updateImage" enctype="multipart/form-data">
                    <label>Зображення:</label>
                    <br>
                    <input type="file" ref="file" @change="handleFileChange"><br>
                    <button type="submit">Оновити</button>
                </form>

                <select @change="savePlaceId" class="form-select mb-3" v-model="tour.place.id">
                    <option v-for="place in places" :key="place.id" :value="place.id">
                        {{ place.name + ', ' + place.country.name }}
                    </option>
                </select>

                {{ tour.place.id }}

                <select @change="saveDiscountId" class="form-select mb-3" v-model="tour.discount.id">
                    <option v-for="discount in discounts" :key="discount.id" :value="discount.id">{{
                            discount.size
                        }}%
                    </option>
                </select>

                <div class="input-group mb-3">
                    <span class="input-group-text">Description</span>
                    <textarea @blur="saveDescription" class="form-control" rows="4" v-model="tour.description">{{tour.description}}</textarea>
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
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'tourId'
    ],
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

            file: null,

            errored: false,
            loader: true,
            places: [], // список місць
            discounts: [], // список знижок
        }
    },
    methods: {


        handleFileChange(event) {
            this.tour.image = event.target.files[0];
        },

        updateImage() {
            const formData = new FormData();
            // if (this.file) {
            //     console.log(`this.file isn't empty`)
            //     formData.append('image', this.file, this.file.name);
            // }
            formData.set('image', this.tour.image)
            axios.put(`/api/tours/${this.tourId}`, formData)
                .then(response => {
                    console.log(formData)
            })
                .catch(error => {
                // handle error
            });
        },

        savePlaceId() {
            axios.put('/api/tours/' + this.tourId, {
                place_id: this.tour.place.id
            })
                .then(response => {

                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        saveName() {
            axios.post('/api/tours/' + this.tourId, {
                _method: 'PUT',
                name: this.tour.name
            })
                .then(response => {
                    // console.log('name: ' + this.tour.name)
                    // Обробка успішного відгуку
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        savePrice() {
            axios.post('/api/tours/' + this.tourId, {
                _method: 'PUT',
                price: this.tour.price
            })
                .then(response => {
                    // Обробка успішного відгуку
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        saveDescription() {
            axios.post('/api/tours/' + this.tourId, {
                _method: 'PUT',
                description: this.tour.description
            })
                .then(response => {
                    // Обробка успішного відгуку
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        // saveImage() {
        //     axios.post('/api/tours/' + this.tourId, {
        //         _method: 'PUT',
        //         headers: {
        //             'Content-Type': 'multipart/form-data'
        //         },
        //         image: this.tour.image
        //     })
        //         .then(response => {
        //             // Обробка успішного відгуку
        //             console.log('this.tour.image: ' + this.tour.image)
        //         })
        //         .catch(error => {
        //             console.log(error);
        //             this.errored = true;
        //         })
        //         .finally(() => {
        //             this.loader = false;
        //         });
        // },

        saveDiscountId() {
            axios.post('/api/tours/' + this.tourId, {
                _method: 'PUT',
                discount_id: this.tour.discount.id
            })
                .then(response => {
                    // Обробка успішного відгуку
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        imageUrl(imageName) {
            return '/storage/' + imageName
        },

        getTour() {
            axios.get('/api/tours/' + this.tourId)
                .then(response => {
                    this.tour = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => {
                    this.loader = false
                })
        },
        getPlaces() {
            axios.get('/api/places')
                .then(response => {
                    this.places = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => {
                    this.loader = false
                })
        },
        getDiscounts() {
            axios.get('/api/discounts')
                .then(response => {
                    this.discounts = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => {
                    this.loader = false
                })
        }
    },
    mounted() {
        this.getTour()
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
