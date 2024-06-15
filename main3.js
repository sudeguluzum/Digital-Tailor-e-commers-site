import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

// Model div elemanını seç
const modelDiv = document.querySelector('.model');

// Sahne oluştur
const scene = new THREE.Scene();
scene.background = new THREE.Color("rgb(251, 229, 223)");

// Kamera oluştur
const camera = new THREE.PerspectiveCamera(75, modelDiv.clientWidth / modelDiv.clientHeight, 0.1, 1000);
camera.position.set(0, 2, 5); // Yüksekliği artırarak yukarıdan bakış sağla

// Renderer oluştur ve ayarla
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(modelDiv.clientWidth, modelDiv.clientHeight);
renderer.setPixelRatio(window.devicePixelRatio);
renderer.shadowMap.enabled = true; // Gölge haritasını etkinleştir
modelDiv.appendChild(renderer.domElement);

// Kontrolleri ekleyerek OrbitControls oluştur
const controls = new OrbitControls(camera, renderer.domElement);

// Işık ekle
const ambientLight = new THREE.AmbientLight(0xffffff, 2); // Ortam ışığı, yoğunluğu artırıldı
scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xffffff, 2); // Yönlü ışık, yoğunluğu artırıldı
directionalLight.position.set(5, 10, 7.5);
directionalLight.castShadow = true; // Gölge oluşturmayı etkinleştir
scene.add(directionalLight);

// Işık gölgeleri daha yumuşak yapmak için ışık özelliklerini ayarla
directionalLight.shadow.mapSize.width = 2048;
directionalLight.shadow.mapSize.height = 2048;
directionalLight.shadow.camera.near = 0.5;
directionalLight.shadow.camera.far = 500;

// Yüzey gölgeleri için düzlem ekle
const planeGeometry = new THREE.PlaneGeometry(200, 200);
const planeMaterial = new THREE.ShadowMaterial({ opacity: 0.3 });
const plane = new THREE.Mesh(planeGeometry, planeMaterial);
plane.rotation.x = - Math.PI / 2;
plane.position.y = -3;
plane.receiveShadow = true;
scene.add(plane);

// GLTF model yükleyici oluştur
const loader = new GLTFLoader();
let avatar;

loader.load(
  'modeller/kiyafet_' + kiyafet_id + "/" + kumas_id + '.glb',
  function (gltf) {
    avatar = gltf.scene;

    const widthMultiplier = 4;
    avatar.scale.set(widthMultiplier, 3, widthMultiplier);

    avatar.position.y = -3;

    avatar.traverse((node) => {
      if (node.isMesh) {
        node.castShadow = true; // Gölge oluşturmayı etkinleştir
        node.receiveShadow = true; // Gölge almayı etkinleştir

        // Materyal özelliklerini ayarla
        node.material.metalness = 0.2;
        node.material.roughness = 0.6;
        node.material.color = new THREE.Color(0xFFFFFF); // Materyal rengini daha açık yap

        // Materyal üzerinde gölge ve ışık efektlerini iyileştir
        node.material.needsUpdate = true;
      }
    });

    // Başın bakması gereken yönü belirle (örneğin, pozitif Z yönüne)
    const headDirection = new THREE.Vector3(0, 0, 1);
    avatar.lookAt(avatar.position.clone().add(headDirection));

    scene.add(avatar);
  },
  function (xhr) {
    console.log((xhr.loaded / xhr.total * 100) + '% yüklendi');
  },
  function (error) {
    console.log("Model dosyası yüklenemedi");
  }
);

// Animasyon fonksiyonu
function animate() {
  requestAnimationFrame(animate);
  if (avatar) {
    avatar.rotation.y += 0.01;
  }
  controls.update();
  renderer.render(scene, camera);
}

animate();

// Pencere yeniden boyutlandırıldığında kameranın en boy oranını ve renderer boyutunu güncelle
window.addEventListener('resize', () => {
  camera.aspect = modelDiv.clientWidth / modelDiv.clientHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(modelDiv.clientWidth, modelDiv.clientHeight);
});
