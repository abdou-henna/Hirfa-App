/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        "hirfa-one-01": "#36677C",
        "hirfa-one-02": "#23586F",
        "hirfa-one-03": "#588192",
        "hirfa-two-01": "#464B84",
        "hirfa-two-02": "#161842",
        "hirfa-three-01": "#DF5939",
        "hirfa-three-02": "#C93E17",
        "hirfa-four-01": "#EEF3F4",
        "hirfa-four-02": "#DEE6EA",
        "hirfa-five-01": "#EBBD24",
        "hirfa-five-02": "#E89704",
        "hirfa-six": "#91482E",
        "hirfa-seven": "#91482E",
        "hirfa-black": "#000000",
        "hirfa-black-02": "#222222",
      }
    },
    container: {
      padding: "2rem",
      center: "true",
    },
    screens: {
      lg: "1700px",
      md: "1100px",
      sm: "640px",
      'rf': {'max': '640px'}, 
    },
  },
  plugins: [],
}