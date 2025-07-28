function xDataLayoutEcommerce() {
    return {
        estadoSuperponer: false,
        toggleSuperponer() {
            this.estadoSuperponer = !this.estadoSuperponer;
        },
        activarSuperponer() {
            this.estadoSuperponer = true;
        },
        cerrarSuperponer() {
            this.estadoSuperponer = false;
        },
        cerrarTodo() {
            this.estadoSuperponer = false;

            document.dispatchEvent(new CustomEvent('cerrar-sidebars-ecommerce'));
        },
        initLayoutEcommerce() {
            document.addEventListener('activar-superponer', () => {
                this.activarSuperponer();
            });

            document.addEventListener('cerrar-superponer', () => {
                this.cerrarSuperponer();
            });
        }
    };
}

function xDataMenuEcommerce() {

    return {
        estadoAsideAbierto: false,
        initMenuEcommerce() {
            this.$watch('estadoAsideAbierto', value => {
                document.body.style.overflow = value ? 'hidden' : 'auto';
            });

            window.addEventListener('resize', () => {
                this.cerrarSidebars();
            });

            document.addEventListener('cerrar-sidebars-ecommerce', () => {
                this.cerrarSidebars();
            });
        },

        toggleContenedorSidebar() {
            this.estadoAsideAbierto = !this.estadoAsideAbierto

            if (this.estadoAsideAbierto) {
                this.activarSuperponer();
            } else {
                this.cerrarSuperponer();
                this.cerrarSidebars();
            }
        },     

        cerrarSidebars() {
            this.estadoAsideAbierto = false
            this.cerrarSuperponer();
        },

        activarSuperponer() {
            document.dispatchEvent(new CustomEvent('activar-superponer'));
        },

        cerrarSuperponer() {
            document.dispatchEvent(new CustomEvent('cerrar-superponer'));
        },
    };
}