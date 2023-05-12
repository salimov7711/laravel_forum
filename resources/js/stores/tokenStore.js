import { defineStore } from "pinia";

export const useRenderStore = defineStore("renderStore", {
  state: () => ({
		render : 0
	}),
	getters: {

	},
	actions: {
		forceRender() {
			this.render++
		}
	}
});