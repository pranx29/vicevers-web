import { initializeApp } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js";
import {
  getStorage,
  ref,
  uploadBytes,
  getDownloadURL,
} from "https://www.gstatic.com/firebasejs/9.0.0/firebase-storage.js";

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDkR_GbW-DNZgSl9_7zjtqIpzNkfA2RT5s",
  authDomain: "viceversa-ad128.firebaseapp.com",
  projectId: "viceversa-ad128",
  storageBucket: "viceversa-ad128.appspot.com",
  messagingSenderId: "852330960599",
  appId: "1:852330960599:web:6900bda120866388ecc292",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const storage = getStorage(app);

async function uploadImage(file, path, callback) {
  if (!file) {
    throw new Error("No file provided");
  }
  if (!path) {
    throw new Error("No path provided");
  }

  const storageRef = ref(storage, path); // Create a reference to the file path

  try {
    // Upload file
    const snapshot = await uploadBytes(storageRef, file);
    console.log("Upload successful:", snapshot);

    // Get the download URL
    const downloadURL = await getDownloadURL(storageRef);

    // Execute the callback function if provided
    if (callback && typeof callback === "function") {
      callback(downloadURL);
    }

    return downloadURL;
  } catch (error) {
    console.error("Error uploading file:", error);
    throw error;
  }
}

document
  .getElementById("fileInput")
  .addEventListener("change", async (event) => {
    const files = event.target.files; // Get selected files
    const imagePreviewContainer = document.getElementById(
      "imagePreviewContainer",
    );
    const imageUrls = []; // Array to store the download URLs of uploaded images

    // Clear previous image previews and reset image URLs
    imagePreviewContainer.innerHTML = "";
    document.getElementById("imageUrls").value = "";

    // Loop through each selected file
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const path = `images/${file.name}`; // Define the path in Firebase Storage

      try {
        // Upload the image and get the download URL
        const downloadURL = await uploadImage(file, path);

        // Append the download URL to the array of image URLs
        imageUrls.push(downloadURL);

        // Create an img element to display the image preview
        const imgElement = document.createElement("img");
        imgElement.src = downloadURL;
        imgElement.classList.add(
          "object-cover",
          "w-24",
          "h-24",
          "rounded-lg",
          "shadow-md",
          "bg-white",
        );

        // Append the image preview to the preview container
        imagePreviewContainer.appendChild(imgElement);
      } catch (error) {
        console.error("Error uploading image:", error);
      }
    }

    // Update the hidden input field with the list of image URLs (as a JSON string or comma-separated)
    document.getElementById("imageUrls").value = JSON.stringify(imageUrls);
  });
