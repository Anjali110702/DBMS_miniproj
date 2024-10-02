function runAnimations() {
    document.querySelector("#id-3717").addEventListener("click", func_3717_377);
  
    function func_3717_377(e) {
      e.stopPropagation();
  
      document.querySelector("#id-372").classList.add("animationClass-372");
      document.querySelector("#id-3710").classList.add("animationClass-3710");
      document.querySelector("#id-3711").classList.add("animationClass-3711");
      document.querySelector("#id-3712").classList.add("animationClass-3712");
      document.querySelector("#id-3713").classList.add("animationClass-3713");
      document.querySelector("#id-3714").classList.add("animationClass-3714");
      document.querySelector("#id-3715").classList.add("animationClass-3715");
      document.querySelector("#id-3716").classList.add("animationClass-3716");
      document.querySelector("#id-3717").classList.add("animationClass-3717");
      document.querySelector("#id-3727").classList.add("animationClass-null3727");
      document.querySelector("#id-3718").classList.add("animationClass-3718");
      document
        .querySelector("#id-3717")
        .removeEventListener("click", func_3717_377);
    }
  }
  runAnimations();
  