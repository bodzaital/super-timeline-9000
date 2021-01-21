let communicator = document.querySelector("#super_timeline_9000_communicator");

if (communicator != null) {
	receive();
} else {

}

function receive() {
	let m = communicator.dataset.message;

	if (m.includes("editing")) {
		handleEditingEvents();
	}
}

function handleEditingEvents() {
	let add_btn = document.querySelector("#timeline-add");
	let remove_btn = document.querySelector("#timeline-remove");

	add_btn.addEventListener("click", (e) => {
		e.preventDefault();

		let clone = document.querySelector(".super_timeline_9000_cloneable").cloneNode(true);
		clone.classList = [];
		clone.classList.add("super_timeline_9000_clone");

		let counter = document.querySelector("#_super_timeline_9000_entries");

		let clonedHead = clone.querySelector("[id^=_super_timeline_9000_head-]");
		clonedHead.id += counter.value;
		clonedHead.name += counter.value;

		let clonedContent = clone.querySelector("[id^=_super_timeline_9000_content-]");
		clonedContent.id += counter.value;
		clonedContent.name += counter.value;

		counter.value++;
		
		let parent = document.querySelector(".super_timeline_9000_cloneParent");
		parent.appendChild(clone);
	});

	remove_btn.addEventListener("click", (e) => {
		e.preventDefault();

		let latestClone = document.querySelector(".super_timeline_9000_clone:last-of-type");

		if (latestClone == null) {
			alert("no clone to remove");
			return;
		}

		let counter = document.querySelector("#_super_timeline_9000_entries");
		counter.value--;

		latestClone.remove();
	});
}