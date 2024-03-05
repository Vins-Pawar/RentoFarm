function toggleMenu() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    if (sidebar.style.width === '250px') {
        sidebar.style.width = '0';
        mainContent.style.marginLeft = '0';
    } else {
        sidebar.style.width = '250px';
        mainContent.style.marginLeft = '250px';
        sidebar.style.visibility="visible";
    }
}

// ... (previous code) ...

function searchEquipment() {
    const searchTerm = document.getElementById('searchEquipment').value.toLowerCase();
    const equipmentList = document.querySelectorAll('.equipment-item');

    equipmentList.forEach(item => {
        const itemName = item.textContent.toLowerCase();
        if (itemName.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

