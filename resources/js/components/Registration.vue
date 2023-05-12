<template>
    <div class="w-25">
        <input
            v-model="name"
            type="name"
            placeholder="name"
            class="form-control mt-3"
        />
        <input
            v-model="email"
            type="email"
            placeholder="email"
            class="form-control mt-3"
        />
        <input
            v-model="password"
            type="password"
            placeholder="password"
            class="form-control mt-3"
        />
        <input
            v-model="password_confirmation"
            type="password"
            placeholder="password_confirmation"
            class="form-control mt-3"
        />
        <input
            @click.prevent="registr()"
            type="submit"
            value="registr"
            class="btn btn-primary mt-3"
        />
    </div>
</template>

<script lang="js">
import axios from 'axios';

export default {
	name: 'Registration',
	data() {
		 return{
			name: null,
			email: null,
			password:null,
			password_confirmation: null,
		 }
	},

	methods: {

		registr() {

			axios.get('/sanctum/csrf-cookie').then(response => {
				axios.post('/register',{
					email:this.email,
					name:this.name ,
					password:this.password,
					password_confirmation:this.password_confirmation})
					.then(res => {
						localStorage.setItem('x-xsrf-token',res.config.headers['X-XSRF-TOKEN']);
						this.$router.push('/user/personal')
						console.log(response)
					})
				});

		},
	},


}
</script>

<style lang="scss" scoped></style>
