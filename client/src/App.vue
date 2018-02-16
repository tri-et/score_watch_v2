<template>
  <div id="app">
    <menuheader></menuheader>
    <router-view/>
  </div>
</template>

<script>
import menuheader from "@/components/menuHeader";
export default {
  name: "App",
  components: {
    menuheader
  }
};
</script>

<style>
#app {
  font-family: "Roboto";
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  max-width: 1280px;
  margin: auto;
  padding: 0px;
   display: flex;
  flex-direction: column; 
  font-family: Roboto;
  min-width: 320px;

  justify-content: flex-start; 
  align-items: stretch; 
  align-content: stretch;
  height: 100vh;
  background-color:aqua 
}
::-webkit-scrollbar {
    width: 4px;

}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.3);
    box-shadow: 0 0 transparent;
    outline: none;
    border: none;
}

::-webkit-scrollbar-thumb {
    /* background-color: #cacaca; */
    border:none;
    border-radius: 10px;
    background: linear-gradient(180deg, #FFFFFF 0%, rgba(255,255,255,0) 100%);
}
</style>
