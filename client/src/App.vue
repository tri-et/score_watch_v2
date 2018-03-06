<template>
  <div id="app">
    <menuheader></menuheader>
    <router-view/>
    <help></help>
  </div>
</template>

<script>
import menuheader from "@/components/menuHeader";
import help from "@/components/help"
export default {
  name: "App",
  components: {
    menuheader,
    help
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
  position: relative;
}

::-webkit-scrollbar {
  width: 4px;
}

::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.3);
  box-shadow: 0 0 transparent;
  outline: none;
  border: none;
  margin-top: 16px;
}

::-webkit-scrollbar-thumb {
  /* background-color: #cacaca; */
  border: none;
  border-radius: 10px;
  background: linear-gradient(180deg, #ffffff 0%, rgba(255, 255, 255, 0) 50%);
}
</style>
