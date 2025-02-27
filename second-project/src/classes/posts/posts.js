document.getElementById("logout").addEventListener("click", event => {


  $.ajax({
    type: "POST",
    url: "/logout",
    data: {},
    success: (data) => {
      window.location.href = "/auth";
    }
  });


});


document.getElementById("post-btn").addEventListener("click", event => {

  const el = {
    title: document.getElementById("inp-title"),
    text: document.getElementById("inp-text"),
    tags: document.getElementById("inp-tags"),
  };

  const title = el.title.value;
  const text = el.text.value;
  const tags = el.tags.value;

  if(!title || !text || !tags) {
    if(!title) {
      el.title.classList.add("required-error");
    }
    if(!text) {
      el.text.classList.add("required-error");
    }
    if(!tags) {
      el.tags.classList.add("required-error");
    }

    return;
  }


  $.ajax({
    type: "POST",
    url: "/posts",
    data: {
      title,
      text,
      tags
    },
    success: (data) => {
      const result = JSON.parse(data);
      if(result.success) {
        let parent = document.getElementById("post-list");

        let postDiv = document.createElement("div");
        postDiv.classList.add("post");
        postDiv.id = `post-${result.postId}`;

        let authorDiv = document.createElement("div");
        authorDiv.classList.add("author");
        authorDiv.innerHTML = `<p>Written by ${result.userEmail}</p>`;

        let titleDiv = document.createElement("div");
        titleDiv.classList.add("title");

        let removeBtn = document.createElement("button");
        removeBtn.classList.add("remove");
        removeBtn.innerHTML = `<img src="./assets/rubbish-bin.svg">`;
        removeBtn.onclick = () => removePost(result.postId);
        titleDiv.appendChild(removeBtn);

        let titleP = document.createElement("p");
        titleP.textContent = title;
        titleDiv.appendChild(titleP);

        let textDiv = document.createElement("div");
        textDiv.classList.add("text");
        textDiv.innerHTML = `<p>${text}</p>`;

        let tagsDiv = document.createElement("div");
        tagsDiv.classList.add("tags");
        tags.split(" ").forEach(tag => {
          let tagP = document.createElement("p");
          tagP.textContent = tag;
          tagsDiv.appendChild(tagP);
        });

        postDiv.appendChild(authorDiv);
        postDiv.appendChild(titleDiv);
        postDiv.appendChild(textDiv);
        postDiv.appendChild(tagsDiv);
        
        parent.appendChild(postDiv);

      }
    }
  });


});



function removePost(id) {
  console.log("REMOVE: ", id);

  const removeEl = (data) => {
    if(JSON.parse(data).success) {
      document.getElementById(`post-${id}`).remove();
    } 
  };

  $.ajax({
    type: "POST",
    url: "/posts-rm",
    data: {
      id
    },
    success: removeEl
  });
}