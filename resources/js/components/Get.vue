<template>
    <div>Get</div>
</template>

<script lang="js">
import axios from 'axios';


export default {
	name: 'Get',
	methods: {
		getData() {
			axios.get('/api/get')
			.then(res => {
				console.log(res);
			})
			.catch(err => {
				console.log(err.response);
			})
		}


	},
	mounted() {
		this.getData();

}
}
</script>

<style lang="scss" scoped></style>
