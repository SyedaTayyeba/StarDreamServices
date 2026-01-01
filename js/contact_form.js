// Detect if form exists on current page
const form = document.getElementById("request");
const formMessage = document.getElementById("formMessage");

if (form) {
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    // Add source if not present (for index page)
    if (!formData.has("source")) {
      formData.append("source", "index");
    }

    // Correct fetch path from root folder
    fetch("php/contact_form.php", {
      method: "POST",
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          formMessage.style.color = "green";
          formMessage.textContent = data.message;
          form.reset();
        } else {
          formMessage.style.color = "red";
          formMessage.textContent = data.message;
        }
      })
      .catch(err => {
        console.error("Fetch error:", err);
        formMessage.style.color = "red";
        formMessage.textContent = "Something went wrong. Try again: " + err.message;
      });
  });
}
